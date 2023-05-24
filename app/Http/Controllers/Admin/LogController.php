<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

class LogController extends CoreController
{
    public function __construct()
    {
        $this->parent = 'log';
        $this->model = 'Log';
        $this->notupdate = [];
        $this->entryName = '';
        $this->routeName = request()->route()->getName();
    }

    public function log()
    {
        if (!getRoleUser($this->routeName, 'read')) {
            return viewNotFound('Access Denided');
        }

        $array = [
            'type' => 'log',
            'routeName' => $this->routeName,
        ];

        $view = '';

        if (request()->ajax()) {
            $view = 'log';
        }

        return setView('admin', 'index', $view, $array);
    }
}
