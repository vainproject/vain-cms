<?php namespace Vain\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'Vain\Http\Middleware\VerifyCsrfToken',
        'Vain\Http\Middleware\LoadUserLocale',
        'Modules\User\Http\Middleware\TrackUserActivity',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'Modules\User\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\User\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'Modules\User\Http\Middleware\RedirectIfAuthenticated',
        'admin' => 'Vain\Http\Middleware\VerfiyBackendPermission',
        'role' => 'Vain\Http\Middleware\EnsureRole',
        'permission' => 'Vain\Http\Middleware\EnsurePermission',
        'payment.provider.enabled' => 'Vain\Http\Middleware\PaymentProviderEnabled',
    ];

}
