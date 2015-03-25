<?php namespace Modules\Site\Providers;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider {

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
        $this->loadTranslationsFrom( $langPath, 'site' );

        $viewPath = __DIR__.'/../Resources/views';
        $this->loadViewsFrom( $viewPath, 'site' );

        $this->composeAdminMenu();
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

    /**
     * provides admin menu for this component
     */
    protected function composeAdminMenu()
    {
        app('menu')->handler('backend')
            ->add(route('site.admin.sites.index'), '<i class="fa fa-file-o"></i><span>'. trans('site::admin.title'));
    }
}
