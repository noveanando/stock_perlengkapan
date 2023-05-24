<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'location';
        $this->model = 'Location';
        $this->notupdate = [];
        $this->entryName = 'location-entry';
        $this->routeName = request()->route()->getName();
    }

    public function location()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'location',
            'routeName' => $this->routeName,
            'location_status' => [
                'type' => 'select',
                'data' => [(object) ['id' => '1', 'text' => 'Aktif'], (object) ['id' => '0', 'text' => 'Non Aktif']],
            ],
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'location';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'location_name' => 'required|unique:locations,location_name',
            'location_status' => 'required',
        ];

        if ($id != 0) {
            $paramValidate['location_name'] = 'required|unique:locations,location_name,' . $id;
        }

        return $paramValidate;
    }

    public function autocomplete(Request $request)
    {
        $search = $request->search;
        $datas = [];
        $datas = Location::select('id', 'location_name as text')->where('location_status', '1');
        if ($request->parent_id) {
            $datas = $datas->where('parent_id', $request->parent_id);
        } else {
            $datas = $datas->where('parent_id', null);
        }

        if ($search) {
            $datas = $datas->where('location_name', 'like', '%' . $search . '%');
        }

        $datas = $datas->limit(10)->get();

        return $datas;
    }
}
