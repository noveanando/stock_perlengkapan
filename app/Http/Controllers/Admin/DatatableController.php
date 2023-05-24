<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function getData(Request $request)
    {
        $result = $this->queryMaster($request, [], true);
        $master = $result['master'];

        return response()->json([
            'data' => $master,
            'draw' => $request->input('draw', 1),
            'recordsTotal' => $result['recordsTotal'],
            'recordsFiltered' => $result['recordsFiltered'],
        ]);
    }

    public function queryMaster($request, $dateOrder = [], $status = false)
    {
        $start = $request->input('start', 0);
        $take = $request->input('length', 25);
        $type = $request->input('type');
        $datatable = $request->input('datatable');

        $created_at = 'created_at';

        $master = DB::table($datatable['table']);
        $arraySelect = [];
        foreach ($datatable['selectTable'] as $select) {
            if (strpos($select, '|') > -1) {
                $eSelect = explode('|', $select);
                $arraySelect[] = DB::raw($eSelect[1]);
            } else {
                $arraySelect[] = $select;
            }
        }

        $master = $master->select(...$arraySelect);
        if (isset($datatable['join'])) {
            $join = $datatable['join'];
            if (is_array($join['table'])) {
                for ($i = 0; $i < count($join['table']); $i++) {
                    $relation = $join['relation'][$i];
                    $master = $master->leftJoin($join['table'][$i], $relation[0], '=', $relation[1]);
                }
            } else {
                $master = $master->leftJoin($join['table'], $join['relation'][0], '=', $join['relation'][1]);
            }

            $created_at = $datatable['table'] . '.created_at';
        }

        if (isset($datatable['where'])) {
            foreach ($datatable['where'] as $where) {
                $master = $master->whereRaw($where[0] . $where[1] . $where[2]);
            }
        }

        if ($request->search) {
            $cols = $datatable['filter']['table'][0];
            $master = $master->where($cols, 'like', '%' . $request->search . '%');
        }

        if (isset($datatable['filterAuth'])) {
            foreach ($datatable['filterAuth'] as $fa) {
                if (isset($request->{$fa})) {
                    $master = $master->where($fa, $request->{$fa});
                }

            }
        }

        $recordsTotal = $master->count();

        if (isset($datatable['filter']['table'])) {
            $filter = array_slice($datatable['filter']['table'], 1);
            foreach ($filter as $colf) {
                $colf1 = $colf;
                $colf = strpos($colf, 'as') > -1 ? explode(' as ', $colf)[1] : $colf;
                if ($request->{$colf} != 'all' && $request->{$colf} != '') {
                    if (isset($datatable['filter']['like']) && in_array($colf, $datatable['filter']['like'])) {
                        $master = $master->where($colf, 'like', '%' . $request->{$colf} . '%');
                    } else {
                        $colf1 = strpos($colf1, '|') > -1 ? explode('|', $colf1)[1] : $colf1;
                        $colf2 = strpos($colf1, 'as') > -1 ? explode(' as ', $colf1)[0] : $colf1;
                        $master = $master->whereRaw($colf2 . '=' . '"' . $request->{$colf} . '"');
                    }
                }
            }
        }

        if (isset($datatable['filter']['between'])) {
            foreach ($datatable['filter']['between'] as $kk => $bet) {
                $arrayBet = [];
                foreach ($bet['value'] as $kb => $be) {
                    if ($request->{$kb}) {
                        $arrayBet[] = $request->{$kb};
                    }
                }

                if (count($arrayBet) == 2) {
                    $master->whereBetween(DB::raw('DATE(' . $bet['column'] . ')'), $arrayBet);
                }
            }
        }

        $recordsFiltered = $master->count();
        if ($status) {
            $master = $master->take($take)->skip($start);
        }

        if (isset($datatable['orderBy'])) {
            if (is_array($datatable['orderBy'][0])) {
                foreach ($datatable['orderBy'] as $ob) {
                    $master = $master->orderBy($ob[0], $ob[1]);
                }
            } else {
                $master = $master->orderBy($datatable['orderBy'][0], $datatable['orderBy'][1]);
            }
        } else {
            $master = $master->orderBy($created_at, 'desc');
        }

        $master = $master->get();

        return ['master' => $master, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal];
    }
}
