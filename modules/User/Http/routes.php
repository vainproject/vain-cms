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
    Route::resource('users', 'UserController', ['names' => [
        'index' => 'user.admin.users.index',
        'create' => 'user.admin.users.create',
        'store' => 'user.admin.users.store',
        'show' => 'user.admin.users.show',
        'edit' => 'user.admin.users.edit',
        'update' => 'user.admin.users.update',
        'destroy' => 'user.admin.users.destroy',
    ]]);

    Route::resource('roles', 'RoleController', ['names' => [
        'index' => 'user.admin.roles.index',
        'create' => 'user.admin.roles.create',
        'store' => 'user.admin.roles.store',
        'show' => 'user.admin.roles.show',
        'edit' => 'user.admin.roles.edit',
        'update' => 'user.admin.roles.update',
        'destroy' => 'user.admin.roles.destroy',
    ]]);

    Route::resource('permissions', 'PermissionController', ['names' => [
        'index' => 'user.admin.permissions.index',
        'create' => 'user.admin.permissions.create',
        'store' => 'user.admin.permissions.store',
        'show' => 'user.admin.permissions.show',
        'edit' => 'user.admin.permissions.edit',
        'update' => 'user.admin.permissions.update',
        'destroy' => 'user.admin.permissions.destroy',
    ]]);
});
