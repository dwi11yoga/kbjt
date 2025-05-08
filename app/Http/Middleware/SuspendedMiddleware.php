<?php

namespace App\Http\Middleware;

use App\Models\Hukuman;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuspendedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // mencegah user tersuspend mensubmit form
        $suspend = Hukuman::where('hukuman', 'like', 'Suspend%')
            ->where('hukuman_berakhir', '>', Carbon::now())
            ->orderBy('hukuman_berakhir', 'desc')
            ->first()
            ->hukuman_berakhir;
        if (!empty($suspend)) {
            return back()
                ->withInput()
                ->with('failed', 'Aksi tidak dapat dilakukan karena akun terkena suspend hingga ' . $suspend->translatedFormat('d F Y H:i') . '.');
        }
        
        // jika aman, maka lanjutkan
        return $next($request);
    }
}
