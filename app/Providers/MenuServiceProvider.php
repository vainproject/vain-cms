<?php namespace Vain\Providers;

use Dowilcox\KnpMenu\Facades\Menu;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Vain\Events\MenuHandlerWasCreated;

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
            $handler = app('menu.frontend');
            $view->with('menu', $handler);

            Event::fire(new MenuHandlerWasCreated($handler, 'app', $view));
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
            $handler = app('menu.backend');
            $view->with('menu', $handler);

            Event::fire(new MenuHandlerWasCreated($handler, 'admin', $view));
        });
    }
}
