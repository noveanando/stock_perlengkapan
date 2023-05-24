<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class JwtVerify
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                try {
                    return response()->json(['status' => 'error', 'message' => 'Token Kedaluwarsa','refresh_token' => auth('api')->refresh()],401);
                } catch (Exception $e) {
                    return response()->json(['status' => 'error', 'message' => 'Token Kedaluwarsa, Silahkan tekan tombol Akun, kemudian tekan keluar','clear_token' => 'true'],401);
                }
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'error', 'message' => 'Token tidak valid, Silahkan tekan tombol Akun, kemudian tekan keluar','clear_token' => 'true'],401);
            }else {
                return response()->json(['status' => 'error', 'message' => 'Token Otorisasi tidak ditemukan, Silahkan tekan tombol Akun, kemudian tekan keluar','clear_token' => 'true'],401);
            }
        }

        return $next($request);
    }
}
