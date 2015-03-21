<?php

Route::group(['prefix' => 'blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
	Route::get('/', [
        'uses' => 'BlogController@getIndex',
        'as' => 'blog.index'
    ]);

    Route::get('{slug}', [
        'uses' => 'BlogController@getPost',
        'as' => 'blog.post.show'
    ]);
});