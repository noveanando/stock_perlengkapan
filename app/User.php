<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'target_id')->where('tables', 'users');
    }
}
