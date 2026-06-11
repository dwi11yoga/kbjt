<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KontributorPengurusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // hanya bisa diakses oleh kontributor dan pengurus
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['kontributor', 'pengurus'])) {
            abort(403, 'Akses ditolak');
            // return response()->view('error.403', [
            //     'title' => 'Akses ditolak'
            // ], 403);
        }
        return $next($request);
    }
}
