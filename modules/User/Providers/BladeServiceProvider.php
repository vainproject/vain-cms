<?php namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('userbadge', function($user) {
            return '<span class="label label-role role-<?php echo '.$user->roles()->ordered()->first()->color.'); ?>"><?php echo '.$user->name.'); ?></span>';
        });
    }

    public function register()
    {
        //
    }
}