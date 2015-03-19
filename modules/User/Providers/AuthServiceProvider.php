<?php namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

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

}
