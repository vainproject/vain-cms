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

        $this->composeViews();
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
    protected function composeViews()
    {
        // user menu in app
        View::composer('app', function($view)
        {
            $view->getFactory()->inject('account', view('user::menu', ['guest' => Auth::guest(), 'user' => Auth::user()]));
        });

        // user menu in admin
        View::composer('admin', function($view)
        {
            $view->getFactory()->inject('account', view('user::admin.account', ['user' => Auth::user()]));
        });
    }
}
