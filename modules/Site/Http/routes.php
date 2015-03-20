<?php

Route::group(['prefix' => 'sites'], function()
{
    Route::get('{slug}', [ 'as' => 'site.detail', 'uses' => 'SiteController@getPage' ]);
});

Route::group(['prefix' => 'admin/sites', 'middleware' => 'auth'], function()
{
    Route::get('/', ['as' => 'site.admin.pages.index', 'uses' => 'AdminController@getIndex']);

    Route::get('add', ['as' => 'site.admin.pages.add', 'uses' => 'AdminController@getAdd']);
    Route::post('add', ['as' => 'site.admin.pages.create', 'uses' => 'AdminController@postAdd']);

    Route::get('{id}', ['as' => 'site.admin.pages.edit', 'uses' => 'AdminController@getPage']);
    Route::post('{id}', ['as' => 'site.admin.pages.save', 'uses' => 'AdminController@postPage']);
    Route::delete('{id}', ['as' => 'site.admin.pages.delete', 'uses' => 'AdminController@deletePage']);
});
