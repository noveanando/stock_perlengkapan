<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

class CategoryController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'category';
        $this->model = 'Category';
        $this->notupdate = [''];
        $this->entryName = 'category-entry';
        $this->routeName = request()->route()->getName();
    }

    public function category()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'category',
            'routeName' => $this->routeName,
            'category_status' => [
                'type' => 'select',
                'data' => [(object) ['id' => '1', 'text' => 'Aktif'], (object) ['id' => '0', 'text' => 'Non Aktif']],
            ],
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'category';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'category_name' => 'required|unique:categories,category_name',
            'category_status' => 'required',
        ];

        if ($id != 0) {
            $paramValidate['category_name'] = 'required|unique:categories,category_name,' . $id;
        }

        return $paramValidate;
    }

    public function autocomplete(Request $request)
    {
        $search = $request->search;
        $datas = [];
        $datas = Category::select('id', 'category_name as text')->where('category_status', '1');
        if ($request->parent_id) {
            $datas = $datas->where('parent_id', $request->parent_id);
        } else {
            $datas = $datas->where('parent_id', null);
        }

        // if ($search != '') {
        $datas = $datas->where('category_name', 'like', '%' . $search . '%');
        // }

        $datas = $datas->limit(10)->get();

        return $datas;
    }
}
