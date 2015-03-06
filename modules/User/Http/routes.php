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