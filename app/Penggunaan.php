<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $primaryKey = 'id_penggunaan';
    protected $table = 'penggunaan';
    protected $fillable = [
        'id_barang', 'history_desc', 'id_user', 'qty', 'id_media'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class,'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function media()
    {
        return $this->belongsTo(Media::class,'id_media');
    }
}
