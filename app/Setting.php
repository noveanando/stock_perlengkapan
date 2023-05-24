<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $fillable = [
		'key', 'type', 'value','status'
	];

	public function media()
	{
		return $this->belongsTo(Media::class,'value');
	}

    public static function importSetting($req)
    {
        return 'true';
    }

	public static function saveSetting($req)
	{
		$requests = $req->except('_token');
		foreach ($requests as $key => $value) {
			$query = Setting::where('type','site')->where('key',$key)->first();
			if (!$query) {
				$query = new Setting;
				$query->key = $key;
				$query->type = 'site';
				$query->status = '1';
			}

			$query->value = $value;
			$query->save();   
		}

		return ['status' => 'success', 'data'=> []];
	}

	public static function saveMultiLang($req)
	{
		$requests = $req->all();
		foreach($requests as $key => $value){
			$query = Setting::where('type','lang')->where('key',$key)->first();
			if(!$query) {
				$query = new Setting;
				$query->key = $key;
				$query->type = 'lang';
				$query->status = '1';
			}

			$query->value = json_encode($value);
			$query->save();  
		}

		return ['status' => 'success', 'data'=> []];
	}

	public function logs()
    {
        return $this->hasMany(Log::class,'target_id')->where('tables','settings');
    }
}
