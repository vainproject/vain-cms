<?php

Route::group(['prefix' => 'forum', 'namespace' => 'Modules\Forum\Http\Controllers'], function()
{
    Route::get('/', 'ForumController@index');
});