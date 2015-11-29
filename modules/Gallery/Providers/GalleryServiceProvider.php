<?php namespace Modules\Gallery\Providers;

use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	public function boot()
	{
		$langPath = __DIR__.'/../Resources/lang';
		$this->loadTranslationsFrom( $langPath, 'gallery' );

		$viewPath = __DIR__.'/../Resources/views';
		$this->loadViewsFrom( $viewPath, 'gallery' );
	}

}
