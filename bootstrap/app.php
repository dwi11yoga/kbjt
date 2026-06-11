<?php

use App\Http\Middleware\CatatKunjunganMiddleware;
use App\Http\Middleware\KepalaMiddleware;
use App\Http\Middleware\KontributorPengurusMiddleware;
use App\Http\Middleware\PengurusMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\PengurusKepalaMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // jangan decrypt cookie dikunjungi
        // agar tidak mengembalikan null saat mendecrypt dikunjungi (dikunjungi tidak di encrypt)
        $middleware->encryptCookies(except: [
            'dikunjungi',
        ]);
        // middleware untuk cek apakah pengguna hari ini sudah mengunjungi website/belom
        $middleware->append(CatatKunjunganMiddleware::class);

        // middleware rule pengguna
        $middleware->alias([
            'kepala' => KepalaMiddleware::class,
            'pengurus' => PengurusMiddleware::class,
            'pengurusKepala' => PengurusKepalaMiddleware::class,
            'kontributorPengurus' => KontributorPengurusMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
