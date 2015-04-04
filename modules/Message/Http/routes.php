<?php

Route::bind('messages', function ($value) {
    if ($thread = Modules\Message\Entities\Thread::forUser(Auth::id())->find($value))
        return $thread;

    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
});

Route::group(['namespace' => 'Modules\Message\Http\Controllers', 'middleware' => 'auth'], function ()
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
