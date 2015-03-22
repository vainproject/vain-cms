<?php namespace Modules\User\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class XmlHttpRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param callable|Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isXmlHttpRequest())
        {
            throw new AccessDeniedHttpException;
        }

        return $next($request);
    }
}