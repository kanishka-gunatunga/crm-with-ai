<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\SetLocale;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Global middleware (optional)
        // $middleware->append(SomeGlobalMiddleware::class);

        // Route middleware
        $middleware->alias([
            'auth' => AuthUser::class,
            'permission' => CheckPermission::class,
            'locale' => SetLocale::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();