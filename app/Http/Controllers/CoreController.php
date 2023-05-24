<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoreController extends Controller
{
    public $parent = '';
    public $root = 'admin';
    public $model = '';
    public $notupdate = [];
    public $entryName = '';
    public $notifActionType = false;
    public $notif = false;
    public $routeName = '';

    public function getDataFirst($id = 0)
    {
        if ($id == 0) {
            if (!getRoleUser(request()->route()->getName(), 'create')) {
                return viewNotFound('Access Denided');
            }

        } else {
            if (!getRoleUser(request()->route()->getName(), 'edit')) {
                return viewNotFound('Access Denided');
            }

        }

        $array = $this->paramGetData($id);
        if ($array['status'] == 'error') {
            return $array['view'];
        }

        $ajax = '';
        if (request()->ajax()) {
            $ajax = $this->parent;
        }

        return setView($this->root, 'inputs.' . $this->parent, $ajax, $array);
    }

    public function paramGetData($id)
    {
        $mainModel = '\\App\\' . $this->model;
        $data = $mainModel::find($id);
        if (!$data) {
            $data = '';
            if ($id != 0) {
                return ['status' => 'error', 'view' => viewNotFound()];
            }

        }

        return [
            'data' => $data,
            'status' => 'success',
            'routeName' => request()->route()->getName(),
        ];
    }

    public function customModel($req)
    {
        return '\\App\\' . $this->model;
    }

    public function saveData(Request $request, $id = 0)
    {
        // return $request->all();
        if ($id == 0) {
            if (!getRoleUser(request()->route()->getName(), 'create')) {
                return response()->json(['status' => 'error', 'message' => 'Access Denided'], 500);
            }
        } else {
            if (!getRoleUser(request()->route()->getName(), 'edit')) {
                return response()->json(['status' => 'error', 'message' => 'Access Denided'], 500);
            }
        }

        $paramValidate = $this->validationForm($id);
        if (count($paramValidate) > 0) {
            $valid = Validator::make($request->all(), $paramValidate);

            if ($valid->fails()) {
                return setError($valid->errors());
            }

        }

        $oldData = [];

        $mainModel = $this->customModel($request);
        $data = $mainModel::find($id);

        if (!$data) {
            if ($id != 0) {
                return ['status' => 'error', 'return' => viewNotFound()];
            }

            $data = new $mainModel;
            $this->notifActionType = true;
        } else {
            $oldData = $data->toArray();
        }

        $before = $this->beforeProcess($request, $id);
        if ($before['status'] == 'error') {
            return response()->json($before, 500);
        }

        $req = $this->inputData($id, $request);

        $data->fill($req);
        $data->save();

        $newData = $data->toArray();

        $request['master_id'] = $id;
        $this->extraSave($data, $request, $oldData, $newData);

        $query = ['status' => 'success', 'data' => $data];

        $diff = array_diff($oldData, $newData);

        unset($diff['updated_at']);
        unset($diff['created_at']);

        if ($id == 0) {
            $this->setLog([
                'page' => $this->parent,
                'data' => $data,
                'label' => 'Tambah',
                'note' => '',
            ]);
        } else {
            if (count($diff) > 0) {
                $this->setLog([
                    'page' => $this->parent,
                    'data' => $data,
                    'label' => 'Ubah',
                    'note' => json_encode($diff),
                ]);
            }
        }

        $this->addLog($id, $data);

        return setResultView('Data berhasil disimpan', $this->routeAfterPost($query, $request));
    }

    public function beforeProcess($request, $id)
    {
        return ['status' => 'success'];
    }

    public function addLog($id, $data)
    {
        return '';
    }

    public function routeAfterPost($query, $request)
    {
        return route($this->entryName, $query['data']->id);
    }

    public function validationForm($id)
    {
        return [];
    }

    public function inputData($id, $req)
    {
        $data = $req->all();
        if ($id != 0) {
            $data = $req->except($this->notupdate);
        }

        return $data;
    }

    public function extraSave($data, $req, $oldData, $newData)
    {
        return '';
    }

    public function deleteData($id)
    {
        if (!getRoleUser(request()->route()->getName(), 'delete')) {
            return response()->json(['status' => 'error', 'message' => 'Access Denided'], 500);
        };

        $check = $this->beforeActionDelete($id);
        if ($check['status'] == 'error') {
            return response()->json(['status' => 'error', 'message' => $check['message']], 500);
        }

        $query = $this->deleteSingle($id);

        if ($query['status'] == 'error') {
            return $query['return'];
        }

        return setResultView('data deleted', $this->routeAfterDelete($id, $query['data']));
    }

    public function routeAfterDelete($id, $param)
    {
        return route($this->parent);
    }

    public function deleteMulti(Request $request)
    {
        if (!getRoleUser(request()->route()->getName(), 'delete')) {
            return response()->json(['status' => 'error', 'message' => 'Access Denided']);
        };

        foreach ($request->ids as $id) {
            $query = $this->deleteSingle((integer) $id);
        }

        return setResultView('data deleted', route($this->parent));
    }

    public function beforeActionDelete($id)
    {
        return ['status' => 'success'];
    }

    public function deleteSingle($id)
    {
        $mainModel = '\\App\\' . $this->model;
        $query = $mainModel::find($id);

        if (!$query) {
            return ['status' => 'error', 'return' => viewNotFound()];
        }

        $this->extraProcessDelete($query);

        $this->setLog([
            'page' => $this->parent,
            'data' => $query,
            'label' => 'Hapus',
        ]);

        $query->delete();

        return ['status' => 'success', 'data' => []];
    }

    public function extraProcessDelete($data)
    {
        return '';
    }

    public function setLog($array)
    {
        if (!isset($array['select'])) {
            $array['select'] = config('getdatatable.' . $array['page'])['selectTable'][0];
        }

        if (!isset($array['extra'])) {
            $array['extra'] = '';
        }

        $desc = $array['label'] . ' ' . $array['data'][$array['select']] . ' ' . $array['extra'];

        if (!isset($array['table'])) {
            $array['table'] = config('getdatatable.' . $array['page'])['table'];
        }

        $note = '';
        if (isset($array['note'])) {
            $note = $array['note'];
        }

        $arrayInsert = [
            'tables' => $array['table'],
            'target_id' => $array['data']['id'],
            'description' => $desc,
            'user_id' => \Auth::user()->id,
            'extra_description' => $note,
        ];
        if (isset($array['public'])) {
            $arrayInsert['public'] = $array['public'];
        }

        return Log::saveLog($arrayInsert);
    }

    public function trace($id)
    {
        if (!getRoleUser(request()->route()->getName(), 'trace')) {
            return viewNotFound('Access Denided');
        }

        $array = $this->selectTrace($id);
        if ($array['status'] == 'error') {
            return $array['view'];
        }

        $ajax = '';
        if (request()->ajax()) {
            $ajax = $this->parent;
        }

        return setView($this->root, 'trace', $ajax, $array);
    }

    public function selectTrace($id)
    {
        $mainModel = '\\App\\' . $this->model;
        $data = $mainModel::find($id);

        if (!$data) {
            return ['status' => 'error', 'view' => viewNotFound()];
        }

        $logs = $data->logs;

        $array = [
            'data' => $data,
            'logs' => $logs,
            'status' => 'success',
        ];

        return $array;
    }
}
