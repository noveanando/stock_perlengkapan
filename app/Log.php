<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'description', 'user_id','tables','target_id','extra_description','public'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    static public function saveLog($request) 
    {
        $query = new Log;
        $query->tables = $request['tables'];
        $query->target_id = $request['target_id'];
        $query->description = $request['description'];
        $query->user_id = $request['user_id'];
        $query->extra_description = $request['extra_description'];

        if(isset($request['public'])) $query->public = $request['public'];
        
        $query->save();
    }
}
