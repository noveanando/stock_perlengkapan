<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'name', 'type', 'media_detail', 'path', 'show_media', 'user_id',
    ];

    public static function saveMedia($req)
    {
        $query = new Media;
        $query->fill($req->all());
        $query->save();

        return ['status' => 'success', 'data' => $query];
    }

    public static function deleteMultiMedia($ids)
    {
        foreach ($ids as $id) {
            $query = Media::deleteMedia((integer) $id);
        }

        return ['status' => 'success', 'data' => []];
    }

    public static function deleteMedia($id)
    {
        $query = Media::find($id);
        if (!$query) {
            return ['status' => 'error', 'return' => viewNotFound()];
        }

        if (file_exists(public_path($query->path))) {
            unlink(public_path($query->path));
        }

        if ($query->type == 'image') {
            $setCrops = Setting::where('type', 'handle-image')->get();

            foreach ($setCrops as $set) {
                $exp = explode('.', $query->path);
                $path = $exp[0] . '-' . $set->key . '.' . $exp[1];
                if (file_exists(public_path($path))) {
                    unlink(public_path($path));
                }
            }
        }

        $query->delete();

        return ['status' => 'success', 'data' => []];
    }

    public function user()
    {
        return $tgis->belongsTo(User::class);
    }
}
