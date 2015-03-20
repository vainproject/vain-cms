<?php namespace Modules\User\Http\Controllers\Admin;

use Vain\Http\Controllers\Controller;

class RoleController extends Controller {

    function getAdmin()
    {
        return view('user::admin.index');
    }
}