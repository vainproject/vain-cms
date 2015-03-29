<?php

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
| NOTE: Remember that filters are DEPRECATED since Laravel 5. We just use
| them for permission management (as entrust does), since middlewares
| are not capable of parameter handling.
| As soon as it is supported you are highly encouraged to migrate to
| middlewares, this shouldn't be a big deal.
*/

Route::filter('permission', function($route, $request, $value)
{
    if ( ! Entrust::can($value))
    {
        //app()->abort(403, 'Missing permission \''. $value .'\'');
    }
});

Route::filter('role', function($route, $request, $value)
{
    if ( ! Entrust::hasRole($value))
    {
        //app()->abort(403, 'Missing role \''. $value .'\'');
    }
});