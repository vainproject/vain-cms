<?php
/*
 * Authentication
 */
Route::group(['namespace' => 'Auth'], function()
{
    // default auth
    Route::controllers([
        'auth' => 'AuthController',
        'password' => 'PasswordController',
    ]);

    // socialite
    Route::group(['prefix' => 'oauth'], function()
    {
        Route::any('redirect', ['as' => 'social.redirect', 'uses' => 'SocialController@redirect']);
        Route::any('handle', ['as' => 'social.handle', 'uses' => 'SocialController@handle']);
    });
});

/*
 * Frontend
 */
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function()
{
    Route::get('{id}', ['as' => 'user.profile', 'uses' => 'UserController@getProfile']) // only match numeric ids!
        ->where('id', '[0-9]+');

    Route::get('edit', ['as' => 'user.profile.edit', 'uses' => 'UserController@getEdit']);
    Route::post('edit', ['as' => 'user.profile.save', 'uses' => 'UserController@postEdit']);
});

/*
 * Backend
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    Route::group(['prefix' => 'users', 'middleware' => 'auth'], function()
    {
        Route::get('/', ['as' => 'user.admin.index', 'uses' => 'UserController@getAdmin']);
    });

    Route::group(['prefix' => 'roles', 'middleware' => 'auth'], function()
    {
        Route::get('/', ['as' => 'user.admin.index', 'uses' => 'RoleController@getAdmin']);
    });

    Route::group(['prefix' => 'permissions', 'middleware' => 'auth'], function()
    {
        Route::get('/', ['as' => 'user.admin.index', 'uses' => 'PermissionController@getAdmin']);
    });
});
