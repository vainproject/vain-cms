<?php namespace Modules\User\Http\Controllers\Admin;

use Vain\Http\Controllers\Controller;

class UserController extends Controller {

    function getIndex()
    {
        return view('user::admin.users.index');
    }

    function getUser()
    {

    }

    function postUser()
    {

    }
}