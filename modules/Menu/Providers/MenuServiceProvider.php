<?php namespace Modules\Menu\Providers;

use Illuminate\Support\ServiceProvider;

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
		//
	}

}
