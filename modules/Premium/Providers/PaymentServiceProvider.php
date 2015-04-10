<?php namespace Modules\Premium\Providers;

use Illuminate\Support\ServiceProvider;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaymentServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PayPal\Rest\ApiContext', function($app)
        {
            $credentials = new OAuthTokenCredential(
                $app['config']['payment.providers.paypal.client_id'],
                $app['config']['payment.providers.paypal.client_secret']);

            $apiContext = new ApiContext($credentials);
            $apiContext->setConfig($app['config']['payment.providers.paypal.settings']);

            return $apiContext;
        });
    }

}
