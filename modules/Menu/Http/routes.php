<?php

/*
 * Backend
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function() {

    Route::resource('menus', 'MenuController', ['names' => [
        'index' => 'menu.admin.items.index',
        'create' => 'menu.admin.items.create',
        'store' => 'menu.admin.items.store',
        'show' => 'menu.admin.items.show',
        'edit' => 'menu.admin.items.edit',
        'update' => 'menu.admin.items.update',
        'destroy' => 'menu.admin.items.destroy',
    ]]);
});