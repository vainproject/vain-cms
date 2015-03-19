<?php

Route::group(['prefix' => 'site'], function()
{
    Route::get('/', 'SiteController@index');
});