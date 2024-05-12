<?php

use App\Support\Enums\Roles;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function (Application $app) {
            $app->make('router')->name('auth.')->middleware('web')->group(base_path('routes/auth.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('auth.login'));
        $middleware->redirectUsersTo(function () {
            if (request()->user()->role === Roles::ADMIN) {
                return route('dashboard');
            } elseif (request()->user()->role === Roles::UPLOADER) {
                return route('receipts.create');
            } else
                return route('receipts.validate.unvalidated');
        });

        $middleware->validateCsrfTokens(except: ['/login']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
