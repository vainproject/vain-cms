<?php

Route::group(['prefix' => 'support', 'namespace' => '$MODULE_NAMESPACE$\Support\Http\Controllers'], function()
{
	Route::get('/', 'SupportController@index');
});