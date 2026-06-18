<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware alias
        $middleware->alias([
            'super_admin' => SuperAdminMiddleware::class,
            'role' => CheckRole::class,
        ]);

        // Atau jika ingin menggunakan metode lain:
        // $middleware->append(SuperAdminMiddleware::class); // global
        // $middleware->appendToGroup('admin', SuperAdminMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();