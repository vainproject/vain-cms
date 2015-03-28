<?php

Route::group(['prefix' => 'sites'], function()
{
    Route::get('{slug}', [ 'as' => 'site.show', 'uses' => 'SiteController@getPage' ]);
});

Route::group(['prefix' => 'admin/sites', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    Route::get('/', ['as' => 'site.admin.sites.index', 'uses' => 'SiteController@getIndex']);

    Route::get('create', ['as' => 'site.admin.sites.add', 'uses' => 'SiteController@getCreate']);
    Route::post('create', ['as' => 'site.admin.sites.create', 'uses' => 'SiteController@postCreate']);

    Route::get('{id}', ['as' => 'site.admin.sites.edit', 'uses' => 'SiteController@getPage']);
    Route::post('{id}', ['as' => 'site.admin.sites.save', 'uses' => 'SiteController@postPage']);
    Route::delete('{id}', ['as' => 'site.admin.sites.delete', 'uses' => 'SiteController@deletePage']);
});
