<?php

use App\Http\Middleware\UserTypeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'userType' => UserTypeMiddleware::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        // Your scheduled commands here
        $schedule->command('notifications:return')->dailyAt('05:00');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
