<?php namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class LockdownResource
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
        $request->session()->flash('errors', new MessageBag(['lock' => trans('user::permission.lock')]));

        // this middleware will just block all requests
        return redirect()->back();
    }
}