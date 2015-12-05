<?php namespace Modules\Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Menu\Events\PostMenuSetup;
use Modules\Menu\Services\MenuItemBuilder;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the application events.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$langPath = __DIR__.'/../Resources/lang';
		$this->loadTranslationsFrom( $langPath, 'menu' );

		$viewPath = __DIR__.'/../Resources/views';
		$this->loadViewsFrom( $viewPath, 'menu' );
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton('menu.builder', MenuItemBuilder::class);

        view()->composer('app', function($view) {
            // delay event trigger to the very
            // last step of menu creation
            $handler = app('menu.frontend');
            $builder = app('menu.builder');
            event(new PostMenuSetup($handler, $builder));
        });
	}

}
