<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

class AssetStatusController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'asset_status';
        $this->model = 'AssetStatus';
        $this->notupdate = [''];
        $this->entryName = 'asset_status-entry';
        $this->routeName = request()->route()->getName();
    }

    public function asset_status()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'asset_status',
            'routeName' => $this->routeName,
            'status' => [
                'type' => 'select',
                'data' => [(object) ['id' => '1', 'text' => 'Aktif'], (object) ['id' => '0', 'text' => 'Non Aktif']],
            ],
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'asset_status';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'status_name' => 'required|unique:asset_statuses,status_name',
            'status' => 'required',
        ];

        if ($id != 0) {
            $paramValidate['status_name'] = 'required|unique:asset_statuses,status_name,' . $id;
        }

        return $paramValidate;
    }
}
