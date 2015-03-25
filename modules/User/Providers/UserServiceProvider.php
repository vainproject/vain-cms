<?php namespace Modules\User\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $langPath = __DIR__.'/../Resources/lang';
        $this->loadTranslationsFrom($langPath, 'user');

        $viewPath = __DIR__.'/../Resources/views';
        $this->loadViewsFrom($viewPath, 'user');

        $this->composeAdminViews();

        $this->composeAdminMenu();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'Modules\User\Services\Registrar',
            'Modules\User\Services\Updater',
            'Modules\User\Services\Gravatar'
        );
    }

    /**
     * composes admin views
     */
    protected function composeAdminViews()
    {
        View::composer('admin', function($view)
        {
            $view->getFactory()->inject('account', view('user::admin.account', ['user' => Auth::user()]));
        });
    }

    /**
     * provides admin menu for this component
     */
    protected function composeAdminMenu()
    {
        $items = app('menu')->items()
            ->add(route('user.admin.users.index'), '<i class="fa fa-circle-o"></i>'. trans('user::user.title'))
            ->add(route('user.admin.roles.index'), '<i class="fa fa-circle-o"></i>'. trans('user::role.title'))
            ->add(route('user.admin.permissions.index'), '<i class="fa fa-circle-o"></i>'. trans('user::permission.title'));

        app('menu')->handler('backend')
            ->add('#', '<i class="fa fa-users"></i><span>'. trans('user::user.title') .'</span><i class="fa fa-angle-left pull-right"></i>', $items);
    }
}
