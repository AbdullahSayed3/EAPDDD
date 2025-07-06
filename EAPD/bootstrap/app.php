<?php

use App\Http\Middleware\Lang;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Spatie\Permission\PermissionServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \Dirape\Token\TokenServiceProvider::class,
        \Yajra\DataTables\DataTablesServiceProvider::class,
        \Kris\LaravelFormBuilder\FormBuilderServiceProvider::class,
        \Maatwebsite\Excel\ExcelServiceProvider::class,
        PermissionServiceProvider::class,
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(AppServiceProvider::HOME);

        $middleware->throttleApi();

        $middleware->alias([
            'lang' => Lang::class,
            'permission' => PermissionMiddleware::class,
            'role' =>RoleMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
