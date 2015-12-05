<?php

/*
 * Backend
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function() {

    Route::resource('menus', 'MenuController', ['names' => [
        'index' => 'menu.admin.entries.index',
        'create' => 'menu.admin.entries.create',
        'store' => 'menu.admin.entries.store',
        'show' => 'menu.admin.entries.show',
        'edit' => 'menu.admin.entries.edit',
        'update' => 'menu.admin.entries.update',
        'destroy' => 'menu.admin.entries.destroy',
    ]]);
});