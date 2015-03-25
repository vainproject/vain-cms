<?php namespace Vain\Providers;

use Illuminate\Support\ServiceProvider;
use Vain\Packages\Menu\Menu;
use Vain\Packages\Menu\Presenters\AdminLtePresenter;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
        $this->app->singleton('menu' , function() {
            return (new Menu())->registerPresenter('backend', new AdminLtePresenter(trans('admin.menu')));
        });
    }

}
