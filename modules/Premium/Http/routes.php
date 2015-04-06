<?php

Route::group(['prefix' => 'premium', 'namespace' => 'Modules\Premium\Http\Controllers'], function()
{
    Route::get('/', 'PremiumController@index');
});