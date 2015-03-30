<?php namespace Vain\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;

class VerfiyBackendPermission {

    /**
     * @var \Zizaco\Entrust\Entrust
     */
    protected $entrust;

    function __construct(Application $app)
    {
        $this->entrust = $app->make('entrust');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $this->entrust->can('app.admin.show'))
        {
            if ($request->ajax())
            {
                return response('Forbidden.', 403);
            }
            else
            {
                return app()->abort(403, 'No permission to view backend');
            }
        }

        return $next($request);
    }

}
