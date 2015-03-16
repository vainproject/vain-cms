<?php

Route::group(['prefix' => 'social'], function($router)
{
    Route::any('redirect', ['as' => 'social.redirect', 'uses' => 'SocialController@redirect']);
    Route::any('handle', ['as' => 'social.handle', 'uses' => 'SocialController@handle']);
});

Route::controllers([
    'auth' => 'AuthController',
    'password' => 'PasswordController',
]);

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function($router)
{
    Route::get('{id}', ['as' => 'user.profile', 'uses' => 'UserController@getProfile']) // only match numeric ids!
        ->where('id', '[0-9]+');

    Route::get('edit', ['as' => 'user.profile.edit', 'uses' => 'UserController@getEdit']);
    Route::post('edit', ['as' => 'user.profile.save', 'uses' => 'UserController@postEdit']);

    Route::get('test', ['as' => 'user.admin', 'uses' => 'UserController@getAdmin']);
});