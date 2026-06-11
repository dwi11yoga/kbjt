<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CatatKunjunganMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // debug dulu
        $response = $next($request);
        // cek apakah hari ini pengguna mengunjungi web (lewat cookie)
        if (!$request->cookie('dikunjungi')) {

            // increment kolom penunjung
            changeStat('pengunjung');

            // buat cookie kalau user sudah mengunjungi web agar tidak dihitung kembali
            // Cookie::queue('dikunjungi', true, 60 * 24);
            $response->headers->setCookie(cookie('dikunjungi', true, 60 * 24));
        }
        return $response;
    }
}
