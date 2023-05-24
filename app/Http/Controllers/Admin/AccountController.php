<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use App\User;
use DB;
use Illuminate\Http\Request;

class AccountController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'account';
        $this->model = 'User';
        $this->notupdate = ['password'];
        $this->entryName = 'account-entry';
        $this->routeName = request()->route()->getName();
    }

    public function account()
    {
        if (!getRoleUser(request()->route()->getName(), 'read')) {
            return viewNotFound('Access Denided');
        }

        $roles = DB::table('roles')->where('id', '!=', 1)->select('id', 'role_name as text')->get();
        $array = [
            'type' => 'account',
            'routeName' => $this->routeName,
            'status' => [
                'type' => 'select',
                'data' => [(object) ['id' => '1', 'text' => 'Aktif'], (object) ['id' => '0', 'text' => 'Non Aktif']],
            ],
            'role_id' => [
                'type' => 'select',
                'data' => $roles,
            ],
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'account';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function paramGetData($id)
    {
        if ($id != 0);
        $data = User::find($id);
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

        $roles = DB::table('roles')->where('status', '1')->get();
        return [
            'data' => $data,
            'roles' => $roles,
            'routeName' => request()->route()->getName(),
            'status' => 'success',
        ];
    }

    public function validationForm($id)
    {
        if ($id == 0) {
            $paramValidate = [
                'name' => 'required|unique:users,name',
                'password' => 'required|string|confirmed',
                'role_id' => 'required',
                'status' => 'required',
            ];
        } else {
            $paramValidate = [
                'name' => 'required|unique:users,name,' . $id,
                'role_id' => 'required',
                'status' => 'required',
            ];
        }

        return $paramValidate;
    }

    public function inputData($id, $req)
    {
        $data = $req->all();
        $data['password'] = bcrypt($req->password);
        if ($id != 0) {
            $data = $req->except($this->notupdate);
        }

        return $data;
    }

    public function autocomplete(Request $request)
    {
        $search = $request->search;
        $role = $request->role;
        $datas = [];
        $datas = User::select('id', 'name as text')->where('status', '1');

        if ($role) {
            $datas = $datas->where('role_id', $role);
        }

        if ($search) {
            $datas = $datas->where('name', 'like', '%' . $search . '%');
        }

        $datas = $datas->limit(10)->get();

        return $datas;
    }

    public function reset($id)
    {
        $data = User::find($id);
        if (!$data) {
            $data = '';
            if ($id != 0) {
                return viewNotFound();
            }

        } else {
            if ($data->role_id == 1) {
                return viewNotFound('Access Denided');
            }

        }

        $data->password = bcrypt('123456789');
        $data->save();

        return setResultView('Reset Password Success', route('account-entry', $id));
    }
}
