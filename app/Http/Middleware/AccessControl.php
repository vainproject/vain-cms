<?php

namespace Vain\Http\Middleware;

use Closure;
use Zizaco\Entrust\EntrustFacade;

class AccessControl {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $permission = $this->getPermissions($request);

        if ($permission !== null)
        {
            if ( ! EntrustFacade::can($permission))
            {
                return response('Forbidden.', 403);
            }
        }

        $role = $this->getRoles($request);

        if ($role !== null)
        {
            if ( ! EntrustFacade::hasRole($role))
            {
                return response('Forbidden.', 403);
            }
        }

        // we just let it pass, this way the middleware can
        // be used in the whole stack without configuring every route

        return $response;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|null
     */
    protected function getPermissions($request)
    {
        $action = $request->route()->getAction();

        if (array_key_exists('permission', $action))
        {
            return $action['permission'];
        }

        return null;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|null
     */
    protected function getRoles($request)
    {
        $action = $request->route()->getAction();

        if (array_key_exists('role', $action))
        {
            return $action['role'];
        }

        return null;
    }
}