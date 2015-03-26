<?php namespace Vain\Providers;

use Dowilcox\KnpMenu\Facades\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application menu.
     *
     * All menues should be registered here and if it makes sense they could be binded
     * to their corresponding views directly
     *
     * @return void
     */
    public function register()
    {
        $this->registerFrontendMenu();

        $this->registerBackendMenu();
    }

    /**
     * build frontend menu and attach it to view
     */
    private function registerFrontendMenu()
    {
        $this->app->singleton('menu.frontend', function() {
            return Menu::create('frontend');
        });

        View::composer('app', function($view) {
            $view->with('menu', app('menu.frontend'));
        });
    }

    /*
 * build backend menu and attach it to view
 */
    private function registerBackendMenu()
    {
        $this->app->singleton('menu.backend', function () {
            return Menu::create('backend');
        });

        View::composer('admin', function ($view) {
                $view->with('menu', app('menu.backend'));
        });
    }
}
