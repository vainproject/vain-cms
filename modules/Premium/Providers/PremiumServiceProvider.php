<?php namespace Modules\Premium\Providers;

use Illuminate\Support\ServiceProvider;

class PremiumServiceProvider extends ServiceProvider {

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
        $this->loadTranslationsFrom( $langPath, 'premium' );

        $viewPath = __DIR__.'/../Resources/views';
        $this->loadViewsFrom( $viewPath, 'premium' );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
