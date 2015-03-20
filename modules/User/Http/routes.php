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
    Route::group(['prefix' => 'users'], function()
    {
        Route::get('/', ['as' => 'user.admin.users.index', 'uses' => 'UserController@getIndex']);

        Route::get('add', ['as' => 'user.admin.users.add', 'uses' => 'UserController@getAdd']);
        Route::post('add', ['as' => 'user.admin.users.create', 'uses' => 'UserController@postAdd']);

        Route::get('{id}', ['as' => 'user.admin.users.edit', 'uses' => 'UserController@getUser']);
        Route::post('{id}', ['as' => 'user.admin.users.save', 'uses' => 'UserController@postUser']);
        Route::delete('{id}', ['as' => 'user.admin.users.delete', 'uses' => 'UserController@deleteUser']);
    });

    Route::group(['prefix' => 'roles'], function()
    {
        Route::get('/', ['as' => 'user.admin.roles.index', 'uses' => 'RoleController@getIndex']);

        Route::get('add', ['as' => 'user.admin.roles.add', 'uses' => 'RoleController@getAdd']);
        Route::post('add', ['as' => 'user.admin.roles.create', 'uses' => 'RoleController@postAdd']);

        Route::get('{id}', ['as' => 'user.admin.roles.edit', 'uses' => 'RoleController@getRole']);
        Route::post('{id}', ['as' => 'user.admin.roles.save', 'uses' => 'RoleController@postRole']);
        Route::delete('{id}', ['as' => 'user.admin.roles.delete', 'uses' => 'RoleController@deleteRole']);
    });

    Route::group(['prefix' => 'permissions'], function()
    {
        Route::get('/', ['as' => 'user.admin.permissions.index', 'uses' => 'PermissionController@getIndex']);

        Route::get('add', ['as' => 'user.admin.permissions.add', 'uses' => 'PermissionController@getAdd']);
        Route::post('add', ['as' => 'user.admin.permissions.create', 'uses' => 'PermissionController@postAdd']);

        Route::get('{id}', ['as' => 'user.admin.permissions.edit', 'uses' => 'PermissionController@getPermission']);
        Route::post('{id}', ['as' => 'user.admin.permissions.save', 'uses' => 'PermissionController@postPermission']);
        Route::delete('{id}', ['as' => 'user.admin.permissions.delete', 'uses' => 'PermissionController@deletePermission']);
    });
});
