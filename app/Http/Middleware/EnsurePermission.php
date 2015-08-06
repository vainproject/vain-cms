<?php

namespace Vain\Http\Middleware;

use Closure;

class EnsurePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $value
     * @return mixed
     */
    public function handle($request, Closure $next, $value)
    {
        if ( ! \Entrust::can($value))
        {
            app()->abort(403, 'Missing permission \''. $value .'\'');
        }

        return $next($request);
    }
}
