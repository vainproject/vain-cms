<?php namespace Modules\User\Http\Controllers\Admin;

use Vain\Http\Controllers\Controller;

class PermissionController extends Controller {

    function getAdmin()
    {
        return view('user::admin.index');
    }
}