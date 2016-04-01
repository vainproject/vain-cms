<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'App\Http\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'App\Http\Middleware\VerifyCsrfToken',
        'App\Http\Middleware\LoadUserLocale',
        'Modules\User\Http\Middleware\TrackUserActivity',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => 'Modules\User\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\User\Middleware\AuthenticateWithBasicAuth',
        'guest'      => 'Modules\User\Http\Middleware\RedirectIfAuthenticated',
        'admin'      => 'Modules\User\Http\Middleware\VerfiyBackendPermission',
        'role'       => 'Modules\User\Http\Middleware\EnsureRole',
        'permission' => 'Modules\User\Http\Middleware\EnsurePermission',
    ];
}
