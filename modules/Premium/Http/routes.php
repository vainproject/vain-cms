<?php

/**
 * Frontend
 */
Route::group(['prefix' => 'premium', 'middleware' => 'auth'], function()
{
    // payment
    Route::group(['prefix' => 'payment', 'namespace' => 'Payment'], function()
    {
        Route::get('/', [ 'as' => 'premium.payment.index', 'uses' => 'IndexController@index' ]);

        // trivial
        Route::get('giropay', [ 'as' => 'premium.payment.giropay.index', 'uses' => 'GiropayController@index' ]);
        Route::get('bitcoin', [ 'as' => 'premium.payment.bitcoin.index', 'uses' => 'BitcoinController@index' ]);

        // payment providers
        Route::group(['prefix' => 'paysafe'], function()
        {
            Route::get('/', [ 'as' => 'premium.payment.paysafe.index', 'uses' => 'PaysafeController@index' ]);
            Route::get('success', [ 'as' => 'premium.payment.paysafe.success', 'uses' => 'PaysafeController@success' ]);
            Route::get('error', [ 'as' => 'premium.payment.paysafe.error', 'uses' => 'PaysafeController@error' ]);
            Route::any('callback', [ 'as' => 'premium.payment.paysafe.callback', 'uses' => 'PaysafeController@callback' ]);
        });

        Route::group(['prefix' => 'paypal'], function()
        {
            Route::get('/', [ 'as' => 'premium.payment.paypal.index', 'uses' => 'PaypalController@index' ]);
            Route::get('success', [ 'as' => 'premium.payment.paypal.success', 'uses' => 'PaypalController@success' ]);
            Route::get('error', [ 'as' => 'premium.payment.paypal.error', 'uses' => 'PaypalController@error' ]);
            Route::any('callback', [ 'as' => 'premium.payment.paypal.callback', 'uses' => 'PaypalController@callback' ]);
        });

        Route::group(['prefix' => 'micropay'], function()
        {
            Route::get('/', [ 'as' => 'premium.payment.micropay.index', 'uses' => 'MicropayController@index' ]);
            Route::get('success', [ 'as' => 'premium.payment.micropay.success', 'uses' => 'MicropayController@success' ]);
            Route::get('error', [ 'as' => 'premium.payment.micropay.error', 'uses' => 'MicropayController@error' ]);
            Route::any('callback', [ 'as' => 'premium.payment.micropay.callback', 'uses' => 'MicropayController@callback' ]);
        });
    });

    Route::get('/', [ 'as' => 'premium.premium.index', 'uses' => 'PremiumController@index' ]);
});

/**
 * Backend
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function()
{
    Route::get('premium', [ 'as' => 'premium.admin.premium.index', 'uses' => 'PremiumController@index' ]);

//    Route::resource('sites', 'SiteController', ['names' => [
//        'index' => 'site.admin.sites.index',
//        'create' => 'site.admin.sites.create',
//        'store' => 'site.admin.sites.store',
//        'show' => 'site.admin.sites.show',
//        'edit' => 'site.admin.sites.edit',
//        'update' => 'site.admin.sites.update',
//        'destroy' => 'site.admin.sites.destroy',
//    ]]);
});
