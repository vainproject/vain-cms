<?php

Route::group(['prefix' => 'blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
	Route::get('/', [
        'uses' => 'BlogController@getIndex',
        'as' => 'blog.index'
    ]);


    Route::get('category/{slug}', [
        'uses' => 'BlogControlle@getCategory',
        'as' => 'blog.category.show'
    ]);

    Route::get('{slug}', [
        'uses' => 'BlogController@getPost',
        'as' => 'blog.post.show'
    ]);

    Route::post('{postId}/comment', [
        'uses' => 'BlogController@postComment',
        'as' => 'blog.comment.create'
    ]);

});