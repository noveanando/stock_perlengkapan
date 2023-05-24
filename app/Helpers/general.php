<?php

function activeMenu($array,$string,$else = '',$classExtra = '')
{
	$result = $else;
	if (array_key_exists('submenu', $array) && count($array['submenu']) > 0) {
		foreach ($array['submenu'] as $value) {
			if ($value['route'] == $string || in_array($string,$value['childs'])) {
				$result = 'active '.$classExtra;
				if ($classExtra != '') $result = $classExtra;
			}
		}
	}else{
		if ($array['route'] == $string || in_array($string,$array['childs'])) {
			$result = 'active '.$classExtra;
		}
	}

	return $result;
}

function getMenu($auth = false)
{
	$roleId = session('userData')['roleId'];
	$array = [];
	foreach (config('menu') as $value) {
		if ($value['route'] == 'newsection') {
			$array[] = $value;
		}else{
			if (sizeof($value['submenu'])) {
				$child = [];
				foreach ($value['submenu'] as $v) {
					if ($roleId == 1) {
						$child[] = $v;
					}else{
						if(getRoleUser($v['route'],'read')){
							$child[] = $v;
						}
					}
				}

				if (sizeof($child) > 0) {
					$value['submenu'] = $child;
					$array[] = $value;
				}
			}else{
				if ($roleId == 1) {
					$array[] = $value;
				}else{
					if(getRoleUser($value['route'],'read')){
						$array[] = $value;
					}
				}
			}
		}
	}	

	$response = $array;
	return (object)$response;
}

function val_exist($object,$key,$default = '')
{
	$res = $default;
	if ($object != '' && isset($object->{$key})) $res = $object->{$key};

	return $res;
}

function checkbox_exist($array,$menu,$key)
{
	$res = '';
	if (sizeof($array)) {
		foreach ($array as $value) {
			if ($value->menu == $menu) {
				if ($value->{$key} == 1) {
					$res = 'checked';
					break;
				}
			}
		}
	}
	
	return $res;
}

function checkbox_array_exist($array,$menu,$column,$key){
	$res = '';
	if (sizeof($array)) {
		foreach ($array as $value) {
			if ($value->menu == $menu && isset($value->{$column})) {
				foreach (json_decode($value->{$column}) as $v) {
					if ($key == $v) {
						$res = 'checked';
						break 2;
					}
				}
			}
		}
	}

	return $res;
}

function id_exist($object)
{
	$res = 0;
	if ($object != '') $res = $object->{$object->getKeyName()};

	return $res;
}

function val_exist_attr($object,$relation,$key,$default = '')
{
	$res = $default;
	if (isset($object->{$relation})) {
		foreach ($object->{$relation} as $k => $value) {
			if ($value->key == $key && $value->value != ''){
				$res = $value->value;
			} 
		}
	}

	return $res;
}

function val_exist_attr_media($object,$relation,$key,$type,$default = '')
{
	$res = $default;
	if (isset($object->{$relation})) {
		foreach ($object->{$relation} as $k => $value) {
			if ($value->key == $key && $value->value != ''){
				$res = $value->media->{$type};
			} 
		}
	}

	return $res;
}

function val_exist_object($object,$relation,$key,$default = '',$image = '')
{
	$res = $default;
	if (isset($object->{$relation}->{$key}) && $object->{$relation}->{$key} != ''){
		$res = $object->{$relation}->{$key};
		if ($image != '') {
			$un = explode('.', $res);
			$res = $un[0].'-'.$image.'.'.$un[1];
		}
	}

	return $res;
}

function form_error($errors,$label)
{
	$res = '';
	if ($errors->has($label)) $res = 'has-error';

	return $res;
}

function firstMenu($menu,$route)
{
	$resMenu = [];
	foreach ($menu as $m) {
		if (count($m['submenu']) > 0) {
			foreach ($m['submenu'] as $sm) {
				if ($sm['route'] == $route || in_array($route, $sm['childs'])) {
					$resMenu = $sm;
					break;
				}
			}
		} else {
			if ($m['route'] == $route || in_array($route, $m['childs'])) {
				$resMenu = $m;
				break;
			}
		}
	}

	return $resMenu;
}

function getAttributPage($menu,$string,$key)
{
	$select = firstMenu($menu,$string);
	$result = $select ? $select[$key] : '';

	return $result;
}

function setView($root,$target,$route,$param = [],$default = 'not-found')
{
	$menu = getMenu(true);
	$param['menu'] = $menu;
	if (view()->exists($root.'.pages.'.$target)) {
		$view = $root.'.pages.'.$target;
	} else {
		$view = $root.'.pages.'.$default;
		if ($default == 'not-found') {
			$param = ['message' => $message];
		}
	}

	if ($route != '') {
		return response()->json(['html'=>(string)view($view,$param),'parent'=>$route]);
	}else{
		return view($root.'.layout',['menu' => $menu,'site_name' => getSite('site_name','Myber')])->with('content', view($view,$param));
	}
}

function setResultView($message = 'Data Berhasil Disimpan', $redirect = '',$status = 'success')
{
	$resArray = [
		'status' => $status,
		'message' => $message,
		'redirect'=> $redirect
	];
	
	return response()->json($resArray);
}

function setError($valid,$status = true)
{
	if ($status) {
		$message = $valid->first();
		$attribut = $valid;
	}else{
		$message = reset($valid);
		$attribut = (object)$valid;
	}

	return response()->json(['status'=>'error','message'=>$message,'redirect'=>'','attribut'=>$attribut],500);	
}

function getRoleUser($roleName,$access = '')
{
	if (session()->has('userData')) {
		$sessionRole = session('userData');
		if (is_string($sessionRole['roleValue'])) {
			if ($sessionRole['roleValue'] == 'superadmin') return true;
		} else {
			if (count($sessionRole['roleValue']) > 0) {
				foreach ($sessionRole['roleValue'] as $value) {
					$explode = explode('-',$roleName);
					if ($value->menu == $roleName || $value->menu == $explode[0]) {
						if (!$access) return $value->other ? $value->other : '[]';

						if($value->{$access} == 1) return true;

						if ($value->other) {
							if (in_array($access,json_decode($value->other))) {
								return true;
							}
						}
					}
				}
			}
		}
	}
	
	return false;
}

function getValueSetting($object,$key,$getsite = false)
{
	$res = '';
	if ($object != '') {
		$dataObject = $object;
		if (!$getsite) {
			$dataObject = $object->value;
		}
		
		$unserialize = unserialize($dataObject);
		foreach ($unserialize as $k => $val) {
			if ($key == $k) {
				$res = $val;
			}
		}
	}

	return $res;
}

function getSite($key,$default = '',$media = false)
{
	if ($media) {
		if (is_array($key)) {
			$data = App\Setting::where('key',$key[0])->where('type',$key[1])->where('value','!=','')->with(['media'])->first();
		}else{
			$data = App\Setting::where('key',$key)->where('value','!=','')->with(['media'])->first();
		}

		if ($data && $data->media) $default = $data->media->path;
	}else{
		if (is_array($key)) {
			$data = App\Setting::where('key',$key[0])->where('type',$key[1])->where('value','!=','')->first();
		}else{
			$data = App\Setting::where('key',$key)->where('value','!=','')->first();
		}

		if ($data) $default = $data->value;
	}

	return $default;
}

function getCropImage($path,$string)
{
	$explode = explode('.', $path);
	$res = $explode[0].'-'.$string.'.'.$explode[1];
	return $res;
}

function filesize_formatted($size)
{
	$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	$power = $size > 0 ? floor(log($size, 1024)) : 0;
	return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

function viewNotFound($message='Data Tidak Ditemukan')
{
	if (request()->ajax()) {
		return response()->json([
			'html'=>(string)view('admin.pages.not-found',['message'=>$message]),
			'parent'=>'',
			'status' => 'error',
			'message' => 'Data Tidak Ditemukan'
		],404);
	}else{
		return view('admin.layout',['menu' => getMenu(true),'site_name' => getSite('site_name','Myber')])->with('content', view('admin.pages.not-found',['message'=>$message]));
	}
}

function sendEmail($template,$array,$file= false)
{
	$res = Mail::send($template, $array, function ($message) use ($array,$file)
	{
		$message->subject($array['subject']);
		$message->from(getSite('email_address'), getSite('email_name'));
		$message->to($array['email']);
		if (isset($array['body'])) {
			$message->setBody($array['body'], 'text/html');
		}

		if($file){
			$message->attachData($file,$array['file_name'].'.pdf');
		}
	});

	return $res;
}

function titlePage($string)
{
	return $string.' | '.getSite('site_name');
}

function resetNumberFormat($number = 0)
{
	if ($number == '' || $number == null) $number = 0;
	return preg_replace('/\,/', '', $number);
}

function getTaxo($data,$type,$target = 'title')
{
	$res = [];
	if ($data && count($data->taxos) > 0) {
		foreach ($data->taxos as $value) {
			if ($value->type == $type) {
				$res[] = $value->{$target};
			}
		}
	}

	return $res;
}

function parentModule($type = 'page')
{
	$datas = App\Module::where('type',$type)->where('parent',0)->where('status','active')->select('id','title')->get();
	return $datas;
}

function replace_template($array,$template)
{
	foreach ($array as $key => $value) {
		$template = str_replace($key, $value, $template);
	}

	return $template;
}

function exportExcel($type,$key = '')
{
	$getConfig = config('exportexcel.'.$type);
	if ($getConfig) {
		return json_encode($getConfig);
	}
	
	return false;
}

function importExcel($type)
{
	$getConfig = config('importexcel.'.$type);
	if ($getConfig) {
		return json_encode($getConfig);
	}
}

function parseDateRangePicker($object,$key,$default = '')
{
	$res = $default;
	if ($object != '' && isset($object->{$key})) {	
		$format = date('d-m-Y',strtotime($object->{$key}));
		$res = str_replace('-', '/', $format);
	}

	return $res;
}

function isWeekend($date) {
	if(date('N', strtotime($date)) == 7){
		$date = date('Y-m-d', strtotime($date.'+1 days'));
	}

    return $date;
}

function handleComa($number) {
	if(!$number) return '0';

	$split = explode('.',$number);
	if(count($split) > 1){
		$reverse = (int)strrev($split[1]);
		$normal = strrev((string)$reverse);
		if($normal > 0) {
			$split[1] = $normal;
		} else {
			unset($split[1]);
		}
	}
	
	return implode('.',$split);
}

function checkFolder()
{
    $target = '/uploads/'.date('Y');
    $path = public_path($target);
    if (!is_dir($path)) {
	    \File::makeDirectory($path, $mode = 0777, true, true);
    }
    
    return ['folder_path' => $path,'path' => $target];
}

function valLangExist($object,$key,$lang,$default = '')
{
	$res = $default;
	if ($object != '' && isset($object->{$key})) {
		$exp = (array)json_decode($object->{$key});
		if(isset($exp[$lang])){
			$res = $exp[$lang];
		}
	}

	return $res;
}

function getMultiLang($key,$array = [], $default = '')
{
	$defaultLang = session('lang') ? session('lang') : 'en';
	$data = App\Setting::where('key',$key)->where('type','lang')->where('value','!=','')->first();
	if ($data && $defaultLang) {
		$exp = (array)json_decode($data->value);
		if(isset($exp[$defaultLang])){
			$default = $exp[$defaultLang];
			foreach($array as $ka => $a){
				$default = str_replace($ka,$a,$default);
			}
		}
	}

	return $default;
}

function uselang($data, $defaultLang = '', $default = '')
{
	if($defaultLang == '') $defaultLang = session('lang') ? session('lang') : 'en';
	
	$exp = (array)json_decode($data);
	if(isset($exp[$defaultLang]) && $exp[$defaultLang] != ''){
		$default = $exp[$defaultLang];
	}

	return $default;
}
