<?php namespace Modules\User\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\User\Entities\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

//        $gate->before(function ($user, $ability) {
//            if ($user->isSuperAdmin()) {
//                return true;
//            }
//        });

        foreach($this->getPermission() as $permission)
        {
            $gate->define($permission->name, function($user) use ($permission) {
                $user->hasRole($permission->roles);
            });
        }
    }

    protected function getPermission()
    {
        return Permission::with('roles')->get();
    }
}