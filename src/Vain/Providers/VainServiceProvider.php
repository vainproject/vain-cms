<?php

namespace Vain\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class VainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $langPath = __DIR__.'/../../../resources/lang';
        $this->loadTranslationsFrom($langPath, 'vain');

        $viewPath = __DIR__.'/../../../resources/views';
        $this->loadViewsFrom($viewPath, 'vain');
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        // bind exception handler
        $this->app->singleton(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            'Vain\Exceptions\Handler'
        );

        $this->registerServiceProviders();

        $this->registerFacades();
    }

    protected function registerServiceProviders()
    {
        /*
        * Application Service Providers...
        */
        $this->app->register(ConfigServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(BusServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(MenuServiceProvider::class);

        /*
         * Package service provider
         */
        $this->app->register(\Pingpong\Modules\ModulesServiceProvider::class);
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        $this->app->register(\Laravel\Socialite\SocialiteServiceProvider::class);
        $this->app->register(\Laravelrus\LocalizedCarbon\LocalizedCarbonServiceProvider::class);
        $this->app->register(\Dowilcox\KnpMenu\MenuServiceProvider::class);
        $this->app->register(\DaveJamesMiller\Breadcrumbs\ServiceProvider::class);

        // in-app packages, may be excluded sometimes later
        $this->app->register(\Vain\Packages\RealmAPI\Providers\RealmApiServiceProvider::class);
    }

    protected function registerFacades()
    {
        $loader = AliasLoader::getInstance();

        /*
         * Custom package facades
         */
        $loader->alias('Inspiring', \Illuminate\Foundation\Inspiring::class);
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        $loader->alias('Socialize', \Laravel\Socialite\Facades\Socialite::class);
        $loader->alias('LocalizedCarbon', \Laravelrus\LocalizedCarbon\LocalizedCarbon::class);
        $loader->alias('DiffFormatter', \Laravelrus\LocalizedCarbon\DiffFactoryFacade::class);
        $loader->alias('Menu', \Laravelrus\LocalizedCarbon\DiffFactoryFacade::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Breadcrumbs', \DaveJamesMiller\Breadcrumbs\Facade::class);
    }
}
