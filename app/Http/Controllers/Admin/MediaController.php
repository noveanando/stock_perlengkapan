<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Media;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Image;

class MediaController extends Controller
{
    public $parent = '';
    public $root = 'admin';
    public $routeName = '';

    public function __construct()
    {
        $this->routeName = request()->route()->getName();
    }

    public function mediaLibrary(Request $request)
    {
        if (!in_array($request->type, ['image', 'video', 'application', 'audio'])) {
            return viewNotFound();
        }

        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $datas = Media::where('type', $request->type);

        if ($request->search) {
            $datas = $datas->where('name', 'like', '%' . $request->search . '%');
        }

        $datas = $datas->orderBy('created_at', 'desc')->paginate(20);
        $array = [
            'datas' => $datas,
            'type' => $request->type,
        ];

        if (request()->ajax()) {
            $this->parent = $request->type;
        }

        return setView($this->root, 'media-library', $this->parent, $array);
    }

    public function getModalMedia(Request $request, $type)
    {
        $queries = new Media;

        $queries = $queries->orderBy('created_at', 'desc')->paginate(12);
        $html = '';
        $datas = [];
        foreach ($queries as $query) {
            $datas[$query->id] = (object) [
                'id' => $query->id,
                'img' => asset(getCropImage($query->path, 'mini')),
                'name' => $query->name,
                'link' => asset($query->path),
                'type' => $query->type,
            ];

            if ($query->type == 'image') {
                $html .= '<div class="col-sm-3 col-xs-4 tes" style="padding:3px;"><label class="select-row" style="margin-bottom:0px;text-align:center;"><input type="checkbox" name="select_media[]" value="' . $query->id . '" style="display:none;"><img src="' . asset($query->show_media == '1' ? getCropImage($query->path, 'mini') : $query->path) . '" style="width:100%"></label></div>';
            } else {
                $exp = explode('.', $query->path);
                $image = 'img/placeholder.jpg';
                $html .= '<div class="col-sm-3 col-xs-4 tes" style="padding:3px;word-break: break-word;"><label class="select-row" style="margin-bottom:0px;text-align:center;"><input type="checkbox" name="select_media[]" value="' . $query->id . '" style="display:none;"><img src="' . asset($image) . '" style="width:100%;max-width:200px;height:auto;"><span class="label-media-library">' . $query->name . '</span></label></div>';
            }
        }

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'datas' => $datas,
            'page' => $request->page,
            'lastPage' => $queries->lastPage(),
            'message' => 'Upload Success',
        ]);
    }

    public function mediaDelete($type, $id)
    {
        $query = Media::deleteMedia($id);
        if ($query['status'] == 'error') {
            return $query['return'];
        }

        return setResultView('data deleted', route($type) . '?type=' . $type . '&page=' . request()->page);
    }

    public function mediaMultiDelete(Request $request, $type)
    {
        $query = Media::deleteMultiMedia($request->ids);
        if ($query['status'] == 'error') {
            return $query['return'];
        }

        return setResultView('data deleted', route($type) . '?type=' . $type);
    }

    public function mediaLibrarySave(Request $request, $settype = '', $trigger = 'false')
    {
        $paramValidate = [];
        $countmedia = count($request->media);
        foreach (range(0, $countmedia - 1) as $index) {
            $paramValidate['media.' . $index] = 'required|file|mimes:' . config('media.image.ext') . ',' . config('media.video.ext') . ',' . config('media.file.ext') . ',' . config('media.audio.ext');
        }

        $valid = Validator::make($request->all(), $paramValidate);
        if ($valid->fails()) {
            return setError($valid->errors());
        }

        $medias = $request->file('media');
        foreach ($medias as $media) {
            $size = $media->getClientSize();
            $type = explode('/', $media->getClientMimeType())[0];
            $mediaValidate = $this->mediaValidation($media, $type);
            if (is_object($mediaValidate)) {
                return $mediaValidate;
            }

            $resSaveMedia = $this->mediaSave($media, $type, $mediaValidate, $size);
            $arrayRes[] = $resSaveMedia;
        }

        if ($trigger == 'true') {
            $req = new Request;
            $req->page = 1;
            return $this->getModalMedia($req, $type);
        }

        return setResultView('data saved', route($settype) . '?type=' . $settype);
    }

    public function mediaValidation($media, $type)
    {
        $mediaSize = $media->getClientSize();
        $mediaExt = $media->getClientOriginalExtension();
        switch ($type) {
            case 'image':
                $dimention = getimagesize($media);
                $config = config('media.image');
                if ($dimention[0] > $config['width'] || $dimention[1] > $config['height']) {
                    return setError(['media' => 'Image dimention max ' . $config['width'] . 'x' . $config['height']], false);
                } elseif ($mediaSize > $config['size']) {
                    return setError(['media' => 'Max file size ' . filesize_formatted($config['size'])], false);
                } else {
                    return $this->uploadImage($media);
                }

                break;
            case 'video':
                $config = config('media.video');
                if ($mediaSize > $config['size']) {
                    return setError(['media' => 'Max file size ' . filesize_formatted($config['size'])], false);
                } else {
                    return $this->uploadFile($media);
                }

                break;
            case 'audio':
                $config = config('media.audio');
                if ($mediaSize > $config['size']) {
                    return setError(['media' => 'Max file size ' . filesize_formatted($config['size'])], false);
                } else {
                    return $this->uploadFile($media);
                }

                break;
            default:
                $config = config('media.file');
                if ($mediaSize > $config['size']) {
                    return setError(['media' => 'Max file size ' . filesize_formatted($config['size'])], false);
                } else {
                    return $this->uploadFile($media);
                }

                break;
        }
    }

    public function mediaSave($media, $type, $up, $size)
    {
        $req = new Request;
        $req->merge([
            'name' => $media->getClientOriginalName(),
            'type' => $type,
            'media_detail' => serialize([
                'ext' => $media->getClientOriginalExtension(),
                'size' => $size,
                'mime_type' => $media->getClientMimeType(),
            ]),
            'path' => $up,
            'user_id' => auth()->user()->id,
        ]);

        $query = Media::saveMedia($req);

        return $query['data'];
    }

    public function uploadFile($media)
    {
        $name = date('Ymd') . str_random(4);
        $ext = strtolower($media->getClientOriginalExtension());
        $mainpath = $name . '.' . $ext;
        $folder = $this->checkFolder();
        $media->move($folder['folder_path'], $mainpath);
        return $folder['path'] . '/' . $mainpath;
    }

    public function uploadImage($media, $type = 'media')
    {
        $name = date('Ymd') . str_random(4);
        $ext = strtolower($media->getClientOriginalExtension());

        $setCrops = Setting::where('type', 'handle-image')->where('status', '1')->get();
        $mainpath = $name . '.' . $ext;
        $img = \Image::make($media);
        $folder = $this->checkFolder();
        $img->save($folder['folder_path'] . '/' . $mainpath);
        if ($type == 'media') {
            if (sizeof($setCrops) > 0) {
                foreach ($setCrops as $set) {
                    $newImg = \Image::make($media);
                    $path = $name . '-' . $set->key . '.' . $ext;
                    $un = unserialize($set->value);
                    $newImg->fit($un['width'], $un['height']);
                    $newImg->save($folder['folder_path'] . '/' . $path);
                }
            }
        }

        return $folder['path'] . '/' . $mainpath;
    }

    public function checkFolder()
    {
        $target = '/uploads/' . date('Y') . '/' . date('d-m');
        $path = public_path($target);
        if (!is_dir($path)) {
            \File::makeDirectory($path, $mode = 0777, true, true);
        }

        return ['folder_path' => $path, 'path' => $target];
    }
}
