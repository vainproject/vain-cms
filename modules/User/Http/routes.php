<?php

Route::get('/', 'UserController@index');

Route::controllers([
    'auth' => 'AuthController',
    'password' => 'PasswordController',
]);