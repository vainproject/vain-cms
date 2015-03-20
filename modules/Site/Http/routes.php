<?php

Route::group(['prefix' => 'sites'], function()
{
    Route::get('{slug}', [ 'as' => 'site.detail', 'uses' => 'SiteController@getPage' ]);
});