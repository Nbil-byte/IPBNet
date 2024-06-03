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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'not_liked' => \App\Http\Middleware\EnsureUserHasNotLikedPost::class,
            'clear_storage' => \App\Http\Middleware\ClearStorage::class,
        ]);

        $middleware->group('web', [
            // Middleware default Laravel untuk grup web
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Tambahkan middleware ini
             // Middleware custom Anda
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
