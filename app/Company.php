<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'company_code', 'status', 'media_id',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
