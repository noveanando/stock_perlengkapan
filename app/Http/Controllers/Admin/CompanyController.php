<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

class CompanyController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'company';
        $this->model = 'Company';
        $this->notupdate = [''];
        $this->entryName = 'company-entry';
        $this->routeName = request()->route()->getName();
    }

    public function company()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'company',
            'routeName' => $this->routeName,
            'status' => [
                'type' => 'select',
                'data' => [(object) ['id' => '1', 'text' => 'Aktif'], (object) ['id' => '0', 'text' => 'Non Aktif']],
            ],
        ];

        $view = '';
        if (request()->ajax()) {
            $view = 'company';
        }

        return setView('admin', 'index', $view, $array);
    }

    public function validationForm($id)
    {
        $paramValidate = [
            'company_name' => 'required|unique:companies,company_name',
            'company_code' => 'required|unique:companies,company_code',
            'status' => 'required',
        ];

        if ($id != 0) {
            $paramValidate['company_name'] = 'required|unique:companies,company_name,' . $id;
            $paramValidate['company_code'] = 'required|unique:companies,company_code,' . $id;
        }

        return $paramValidate;
    }

}
