<?php

Route::group(['prefix' => 'site'], function()
{
    Route::get('{slug}', 'SiteController@getPage');
});