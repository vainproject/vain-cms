<?php

Route::group(['prefix' => 'gallery'], function()
{
	Route::get('/', 'GalleryController@index');
});