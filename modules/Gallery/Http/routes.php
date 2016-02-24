<?php

Route::group(['prefix' => 'gallery'], function()
{
	Route::get('/', 'GalleryController@index');
});

Route::group(['prefix' => 'admin/gallery', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('category', 'CategoryController', ['names' => [
        'index'   => 'gallery.admin.category.index',
        'create'  => 'gallery.admin.category.create',
        'store'   => 'gallery.admin.category.store',
        'show'    => 'gallery.admin.category.show',
        'edit'    => 'gallery.admin.category.edit',
        'update'  => 'gallery.admin.category.update',
        'destroy' => 'gallery.admin.category.destroy',
    ]]);
});