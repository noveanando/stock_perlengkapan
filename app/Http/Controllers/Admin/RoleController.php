<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'role';
        $this->model = 'Role';
        $this->notupdate = ['access'];
        $this->entryName = 'role-entry';
        $this->routeName = request()->route()->getName();
    }

    public function role()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'role',
            'routeName' => $this->routeName,
            'status' => [
                'type' => 'select',
                'data' => [(object) ['id' => '1', 'text' => 'Aktif'], (object) ['id' => '0', 'text' => 'Non Aktif']],
            ],
        ];

        $view = '';

        if (request()->ajax()) {
            $view = 'role';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function paramGetData($id)
    {
        $data = Role::find($id);
        if (!$data) {
            $data = '';
            if ($id != 0) {
                return ['status' => 'error', 'view' => viewNotFound()];
            }

        } else {
            if ($data->role_id == 1) {
                return ['status' => 'error', 'view' => viewNotFound('Access Denided')];
            }

        }

        return [
            'data' => $data,
            'status' => 'success',
            'exist_column' => ['read', 'create', 'edit', 'delete', 'export', 'import'],
        ];
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'role_name' => 'required',
            'status' => 'required',
        ];

        return $paramValidate;
    }

    public function inputData($id, $req)
    {
        $data = $req->except($this->notupdate);

        return $data;
    }

    public function extraSave($data, $req, $oldData, $newData)
    {
        $array = [];
        $keys = [];

        $getRule = [];
        foreach ($data->rules as $rule) {
            $getRule[$rule->menu] = $rule->id;
        }

        if (isset($req->rules) && sizeof($req->rules)) {
            foreach ($req->rules as $key => $value) {
                $action = ['read', 'create', 'edit', 'delete', 'export', 'import'];
                $diff = array_values(array_diff(array_keys($value), $action));

                $accessMenu = [];
                foreach ($action as $ka => $a) {
                    if (isset($value[$a])) {
                        $accessMenu[$a] = 1;
                    } else {
                        $accessMenu[$a] = 0;
                    }
                }

                $newArray = [
                    'id' => isset($getRule[$key]) ? $getRule[$key] : null,
                    'menu' => $key,
                    'other' => json_encode($diff),
                ];

                $array[] = array_merge($newArray, $accessMenu);
            }

            $data->rules()->sync($array);

            $keys = array_keys($req->rules);
        }

        return ['status' => 'success'];
    }
}
