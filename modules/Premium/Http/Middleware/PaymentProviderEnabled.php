<?php namespace Modules\Premium\Http\Middleware;

use Closure;

class PaymentProviderEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $value
     * @return mixed
     * @throws HttpException
     */
    public function handle($request, Closure $next, $value)
    {
        if ( ! config('payment.providers.'.$value.'.enabled'))
            abort(503);

        return $next($request);
    }
}
