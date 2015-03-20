<?php namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\User;
use Vain\Http\Controllers\Controller;

class UserController extends Controller {

    function getIndex()
    {
        $users = User::paginate();

        return view('user::admin.users.index')
            ->with('users', $users);
    }

    function getAdd()
    {

    }

    function postAdd()
    {

    }

    function getUser()
    {

    }

    function postUser()
    {

    }
}