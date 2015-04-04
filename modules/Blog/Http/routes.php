<?php

Route::group(['prefix' => 'blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
	Route::get('/', [
        'uses' => 'PostController@index',
        'as' => 'blog.post.index'
    ]);

    Route::get('{slug}', [
        'uses' => 'PostController@show',
        'as' => 'blog.post.show'
    ]);

    Route::group(['prefix' => 'category'], function() {

        Route::get('{slug}', [
            'uses' => 'CategoryController@show',
            'as' => 'blog.category.show'
        ]);
    });

    Route::group(['prefix' => 'comment'], function() {

        Route::post('{postId}', [
            'uses' => 'CommentController@create',
            'as' => 'blog.comment.create'
        ]);

        Route::delete('{id}', [
            'uses' => 'CommentController@destroy',
            'as' => 'blog.comment.destroy'
        ]);
    });

});