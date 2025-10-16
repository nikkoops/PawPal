<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        
        // Configure authentication redirects
        $middleware->redirectGuestsTo(function () {
            if (request()->is('admin') || request()->is('admin/*')) {
                return route('admin.login');
            }
            return route('admin.login'); // Default fallback
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
