<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use App\Location;
use App\Penggunaan;
use Illuminate\Http\Request;

class PenggunaanController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'penggunaan';
        $this->model = 'Penggunaan';
        $this->notupdate = [];
        $this->entryName = 'penggunaan-entry';
        $this->routeName = request()->route()->getName();
    }

    public function penggunaan()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'penggunaan',
            'routeName' => $this->routeName,
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'penggunaan';
        }

        return setView('admin', 'index', $view, $array);
    }

    

    public function paramGetData($id)
    {
        if ($id != 0);
        $data = Penggunaan::find($id);
        $userPengguna = \DB::table('users')->select('id', 'name as text')->where('status', 1)->get();
        $barangs = \DB::table('assets')->select('id', 'item_name as text')->where('asset_status_id', 1)->get();
        if (!$data) {
            $data = '';
            if ($id != 0) {
                return ['status' => 'error', 'view' => viewNotFound()];
            }
        }

        return [
            'data' => $data,
            'userPengguna' => $userPengguna,
            'barangs' => $barangs,
            'routeName' => request()->route()->getName(),
            'status' => 'success',
        ];
    }
}
