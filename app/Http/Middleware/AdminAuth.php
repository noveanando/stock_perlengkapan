<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->to(route('login') . '?redirect=' . request()->fullUrl());
        }

        return $next($request);
    }
}
