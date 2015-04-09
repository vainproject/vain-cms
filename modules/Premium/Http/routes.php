<?php

/**
 * Frontend
 */
Route::group(['prefix' => 'premium', 'middleware' => 'auth'], function()
{
    // payment
    Route::group(['prefix' => 'payment', 'namespace' => 'Payment'], function()
    {
        Route::get('giropay', [ 'as' => 'premium.payment.giropay.index', 'uses' => 'GiropayController@index' ]);
        Route::get('bitcoin', [ 'as' => 'premium.payment.bitcoin.index', 'uses' => 'BitcoinController@index' ]);
        Route::get('paysafe', [ 'as' => 'premium.payment.paysafe.index', 'uses' => 'PaysafeController@index' ]);
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
