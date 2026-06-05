<?php

use App\Http\Middleware\KepalaMiddleware;
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
        // middleware untuk pengurus dan kepala
        $middleware->alias([
            'pengurusKepala' => PengurusKepalaMiddleware::class
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        // middleware untuk pengurus dan kepala
        $middleware->alias([
            'kepala' => KepalaMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
