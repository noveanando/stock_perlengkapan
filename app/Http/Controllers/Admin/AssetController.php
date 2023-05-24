<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

class AssetController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'asset_data';
        $this->model = 'Asset';
        $this->notupdate = [];
        $this->entryName = 'asset_data-entry';
        $this->routeName = request()->route()->getName();
    }

    public function asset_data()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $assetStatus = \DB::table('asset_statuses')->select('id', 'status_name as text')->where('status', 1)->get();
        $array = [
            'type' => 'asset_data',
            'routeName' => $this->routeName,
            'item_name' => [
                'type' => 'text',
            ],
            'asset_status_id' => [
                'type' => 'select',
                'data' => $assetStatus,
            ],
            'category_id' => [
                'type' => 'select',
                'route' => route('category-autocomplete'),
            ],
            'location_id' => [
                'type' => 'select',
                'route' => route('location-autocomplete'),
            ],
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'asset_data';
        }

        return setView('admin', 'index-qrcode', $view, $array);
    }

    public function paramGetData($id)
    {
        if ($id != 0);
        $data = Asset::find($id);
        // $assetStatus = \DB::table('asset_statuses')->select('id', 'status_name as text')->where('status', 1)->get();
        if (!$data) {
            $data = '';
            if ($id != 0) {
                return ['status' => 'error', 'view' => viewNotFound()];
            }
        }

        return [
            'data' => $data,
            // 'assetStatus' => $assetStatus,
            'routeName' => request()->route()->getName(),
            'status' => 'success',
        ];
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'asset_status_id' => 'required',
            'item_name' => 'required',
        ];

        return $paramValidate;
    }

    public function inputData($id, $req)
    {
        $data = $req->all();
        if ($id == 0) {
            $data['asset_code'] = Asset::generateCode($req->company_id);
        }

        if (!isset($req->child_location_id)) {
            $data['child_location_id'] = null;
        }

        return $data;
    }

    public function extraSave($data, $req, $oldData, $newData)
    {
        $data->uploadFile($req, $data);
        if (count($oldData) == 0) {
            $data->saveHistory('history', $req, $data);
        } else {
            $diff = array_diff_assoc($oldData, $newData);

            unset($diff['updated_at']);
            unset($diff['created_at']);
            unset($diff['media_id']);
            if (count($diff) > 0) {
                $data->saveHistory('history', (object) $diff, $data);
            }
        }
    }

    public function addHistory(Request $request, $id, $status)
    {
        if (in_array($status, ['maintenance'])) {
            $data = Asset::find($id);

            $data->saveHistory($status, $request, $data);
        }

        return setResultView('Perubahan berhasil disimpan', route($this->entryName, $id));
    }

    public function exportExcel(Request $request)
    {
        $config = config('getdatatable')[$this->parent]['filter']['like'];
        $select = [
            'table' => ['asset_code', 'item_name', 'category_name', 'l.location_name as l_name', 'cl.location_name as cl_name', 'status_name', 'asset_desc', 'purchase_date', 'price'],
            'label' => ['Kode', 'Nama Barang', 'Kategori', 'Lokasi', 'Detail Lokasi', 'Status', 'Keterangan', 'Tanggal Pembelian', 'Harga'],
        ];

        $company = \DB::table('companies')->where('id', $request->company_id)->first();
        $datas = \DB::table('assets')->select(...$select['table'])
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->leftJoin('locations as l', 'location_id', '=', 'l.id')
            ->leftJoin('locations as cl', 'child_location_id', '=', 'cl.id')
            ->leftJoin('asset_statuses', 'asset_status_id', '=', 'asset_statuses.id');
        foreach ($request->toArray() as $kr => $req) {
            if (in_array($kr, $config)) {
                $datas = $datas->where($kr, 'like', '%' . $req . '%');
            } elseif ($req != 'all') {
                $datas = $datas->where($kr, $req);
            }
        }

        $datas = $datas->orderBy('asset_code', 'asc')->get();
        $array = [
            'datas' => $datas,
            'type' => 'excel',
            'tableHeader' => $select['label'],
            'company' => $company->company_name,
        ];

        return view('admin.pages.reports.' . $this->parent . '-export', $array);
    }

    public function qrcode(Request $request)
    {
        $location = \App\Location::where('parent_id', null)->get();
        $datas = [];
        if (isset($request->location_id)) {
            $datas = Asset::where('location_id', $request->location_id)->get();
        }

        $prints = [];
        if (isset($request->details) && count(json_decode($request->details)) > 0) {
            $prints = Asset::whereIn('id', json_decode($request->details))->get();
        }

        $array = [
            'locations' => $location,
            'datas' => $datas,
            'prints' => $prints,
            'details' => isset($request->details) ? json_decode($request->details) : [],
        ];

        return view('admin.pages.reports.' . $this->parent . '-qrcode', $array);
    }

    public function searchAsset(Request $request)
    {
        $search = $request->search;
        $data = Asset::where('asset_code', $search)->first();
        $array = [];
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Tidak Ditemukan',
            ], 500);
        }

        $childlocation = $data->childlocation ? ' ( ' . $data->childlocation->location_name . ' )' : '';
        $location = $data->location ? $data->location->location_name : '';

        $array = [
            'asset_code' => $data->asset_code,
            'item_name' => $data->item_name,
            'category' => $data->category ? $data->category->category_name : '',
            'location' => $location . $childlocation,
            'status' => $data->assetstatus ? $data->assetstatus->status_name : '',
            'desc' => $data->asset_desc,
            'image' => $data->media ? asset($data->media->path) : '',
            'image2' => $data->media ? asset(val_exist_object($data, 'media', 'path', 'img/placeholder.jpg', 'mini')) : '',
        ];

        return $array;
    }
}
