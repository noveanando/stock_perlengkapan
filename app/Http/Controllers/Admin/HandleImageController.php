<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

class HandleImageController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'handle-image';
        $this->model = 'Setting';
        $this->notupdate = ['width', 'height', '_token'];
        $this->entryName = 'handle-image-entry';
        $this->routeName = request()->route()->getName();
    }

    public function handleImage()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'handle-image',
            'routeName' => $this->routeName,
        ];
        $view = '';
        if (request()->ajax()) {
            $view = 'handle-image';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'key' => 'required',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'status' => 'required|string',
        ];

        return $paramValidate;
    }

    public function inputData($id, $req)
    {
        $data = $req->except($this->notupdate);

        $array = [
            'width' => $req->width,
            'height' => $req->height,
        ];

        $data['value'] = serialize($array);
        if ($id == 0) {
            $data['type'] = 'handle-image';
        }

        return $data;
    }
}
