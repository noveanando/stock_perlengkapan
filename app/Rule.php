<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'role_id','menu','read','create','edit','delete','export','import','other'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
}
