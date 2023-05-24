<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function homeAdmin()
    {
        return redirect()->route('dashboard');
    }

    public function auth()
    {
        return redirect()->route('login');
    }

    public function login()
    {
        if (!Auth::guest()) {
            $routeRedirect = 'dashboard';
            $auth = Auth::user();

            return redirect()->route($routeRedirect);
        }

        $company = \App\Company::where('status', '1')->get();

        return view('admin.pages.login', ['companies' => $company]);
    }

    public function logout()
    {
        if (!Auth::guest()) {
            Auth::logout();
            return redirect()->route('login', ['redirect' => request()->redirect]);
        }

        abort(404);
    }

    public function postLogin(Request $request)
    {
        $paramValidate = [
            'name' => 'required',
            'password' => 'required',
        ];

        $valid = Validator::make($request->all(), $paramValidate);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        if (\Auth::attempt(['name' => $request->name, 'password' => $request->password, 'status' => '1'])) {
            $redirect = $request->redirect;

            $firstPage = $this->setSession();
            $redirectName = $firstPage;

            if (strpos($redirect, url()->to('/')) > -1) {
                if ($redirect == route('login')) {
                    return redirect()->route($redirectName);
                }

                return redirect()->to($redirect);
            }

            return redirect()->route($redirectName);
        } else {
            return redirect()->back()->withErrors(['email' => 'Periksa kembali username dan password anda'])->withInput();
        }
    }

    protected function setSession()
    {
        $auth = Auth::user();
        $array = ['roleId' => $auth->role_id, 'company_id' => $auth->company_id];
        $firstPageRoute = 'dashboard';

        if ($auth->role_id == 1) {
            $array['roleValue'] = 'superadmin';
        } else {
            $array['roleValue'] = $auth->role->rulesLogin;
            $firstPageRoute = count($auth->role->rulesLogin) > 0 ? $auth->role->rulesLogin[0]->menu : 'dashboard';
        }

        session(['userData' => $array]);

        return $firstPageRoute;
    }

    public function sendEmailPassword()
    {
        return view('admin.pages.email-password');
    }

    public function resetPassword(Request $request, $token = null)
    {
        return view('admin.pages.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
