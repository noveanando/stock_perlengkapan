<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name', 'status'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
    
    public function rulesLogin()
    {
        return $this->hasMany(Rule::class)->select(array('menu', 'read','create','edit','delete','export','import','other'));
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class,'role_status');
    }

    public static function importRole($req)
    {
        return 'true';
    }

    public function logs()
    {
        return $this->hasMany(Log::class,'target_id')->where('tables','roles');
    }
}
