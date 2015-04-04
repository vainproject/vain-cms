<?php

Route::model('messages', 'Modules\Message\Entities\Thread');

Route::group(['namespace' => 'Modules\Message\Http\Controllers', 'middleware' => 'auth'], function()
{

	Route::resource('messages', 'MessageController', ['except' => ['edit'], 'names' => [
		'index' => 'message.message.index',
		'create' => 'message.message.create',
		'store' => 'message.message.store',
		'show' => 'message.message.show',
		'update' => 'message.message.update',
		'destroy' => 'message.message.destroy',
	]]);
});
