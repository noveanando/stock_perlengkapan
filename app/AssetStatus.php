<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    protected $fillable = [
        'status_name', 'status',
    ];
}
