<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'asset_code', 'item_name', 'category_id', 'asset_desc', 'asset_status_id', 'location_id', 'media_id', 'child_location_id', 'company_id', 'purchase_date', 'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function histories()
    {
        return $this->hasMany(AssetHistory::class)->orderBy('created_at', 'desc');
    }

    public function statushistories()
    {
        return $this->hasMany(AssetHistory::class)->where('type', 'history')->orderBy('created_at', 'desc');
    }

    public function maintenances()
    {
        return $this->hasMany(AssetHistory::class)->where('type', 'maintenance');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function childlocation()
    {
        return $this->belongsTo(Location::class, 'child_location_id');
    }

    public function assetstatus()
    {
        return $this->belongsTo(AssetStatus::class, 'asset_status_id');
    }

    public function saveHistory($type, $request, $data)
    {
        switch ($type) {
            case 'history':
                $message = '';
                $itemName = isset($request->item_name) ? ' nama barang ' . $data->item_name : '';
                $category = isset($request->category_id) ? ', kategori ' . $data->category->category_name : '';
                $location = isset($request->location_id) ? ', lokasi ' . $data->location->location_name : '';
                $childLocation = isset($request->child_location_id) ? ', detail lokasi ' . $data->childlocation->location_name : '';
                $status = isset($request->asset_status_id) ? ', status ' . $data->assetstatus->status_name : '';
                $desc = isset($request->asset_desc) ? ', keterangan ' . $data->asset_desc : '';
                $purchase_date = isset($request->purchase_date) ? ', tanggal pembelian ' . date('d/m/Y', strtotime($data->purchase_date)) : '';
                $price = isset($request->price) ? ', harga ' . number_format($data->price) : '';

                if (isset($request->item_id)) {
                    $message = 'Tambah ' . $itemName . $category . $location . $childLocation . $status . $desc . $purchase_date . $price;
                } else {
                    $message = 'Edit ' . $itemName . $category . $location . $childLocation . $status . $desc . $purchase_date . $price;
                }

                break;
            case 'maintenance':
                $message = '';
                if (isset($request->maintenance_message)) {
                    $message = $request->maintenance_message;
                }

                break;
            default:
                $message = '';
                break;
        }

        $this->histories()->create([
            'history_desc' => $message,
            'user_id' => auth()->user()->id,
            'type' => $type,
        ]);

        return ['status' => 'success'];
    }

    public static function generateCode($companyId)
    {
        $year = substr(date('Y'), 2);
        $month = date('m');
        $company = \DB::table('companies')->where('id', $companyId)->first();

        $latest = \DB::table('assets')->select('id', 'asset_code')
            ->where(\DB::raw("DATE_FORMAT(created_at,'%y-%m')"), '=', $year . '-' . $month)
            ->where('company_id', $companyId)
            ->latest()->first();

        $numberCode = 1;
        if ($latest) {
            $lastCode = $latest->asset_code;
            $stringCode = substr($lastCode, 5, strlen($lastCode) - 1);
            $numberCode = (int) $stringCode + 1;
        }

        $nol = '';
        for ($i = 0; $i < (4 - strlen((string) $numberCode)); $i++) {
            $nol .= '0';
        }

        $newCode = $company->company_code . $year . $month . $nol . $numberCode;
        return $newCode;
    }

    public function uploadFile($req, $data)
    {
        if (isset($req->file_upload)) {
            $media = $req->file('file_upload');
            $size = $media->getClientSize();
            $type = explode('/', $media->getClientMimeType())[0];
            $name = date('Ymd') . str_random(4);
            $ext = strtolower($media->getClientOriginalExtension());
            $mainpath = $name . '.' . $ext;

            $folder = checkFolder();
            $media->move($folder['folder_path'], $mainpath);

            $newpath = $folder['path'] . '/' . $mainpath;
            $res = $this->mediaSave($media, $type, $newpath, $size);
            $setCrops = Setting::where('type', 'handle-image')->where('status', '1')->get();
            if (sizeof($setCrops) > 0) {
                foreach ($setCrops as $set) {
                    $newImg = \Image::make(public_path($newpath));
                    $path = $name . '-' . $set->key . '.' . $ext;
                    $un = unserialize($set->value);
                    $newImg->fit($un['width'], $un['height']);
                    $newImg->save($folder['folder_path'] . '/' . $path);
                }
            }

            $data->media_id = $res->id;
            $data->save();
        }

        return ['status' => 'success'];
    }

    public function mediaSave($media, $type, $up, $size)
    {
        $req = new \Illuminate\Http\Request;
        $req->merge([
            'name' => $media->getClientOriginalName(),
            'type' => $type,
            'media_detail' => serialize([
                'ext' => $media->getClientOriginalExtension(),
                'size' => $size,
                'mime_type' => $media->getClientMimeType(),
            ]),
            'path' => $up,
        ]);

        $query = Media::saveMedia($req);

        return $query['data'];
    }
}
