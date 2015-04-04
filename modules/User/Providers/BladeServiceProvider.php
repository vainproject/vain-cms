<?php namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function register()
    {
        // @userbadge($user) - $user is an object of Modules\User\Entities\User
        \Blade::extend(function($view, $compiler)
        {
            $pattern = $compiler->createOpenMatcher('userbadge');

            return preg_replace($pattern, '$1<span class="label label-role role-<?php echo $2->roles()->ordered()->first()->color); ?>"><?php echo $2->name); ?></span>', $view);
        });
    }
}