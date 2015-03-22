<?php namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\Permission;
use Vain\Http\Controllers\Controller;

class PermissionController extends Controller {

    function getIndex()
    {
        $permissions = Permission::paginate(1);

        return view('user::admin.permissions.index')
            ->with('permissions', $permissions);
    }

    function getAdd()
    {
        return view('user::admin.permissions.add');
    }

    function postAdd()
    {

    }

    function getPermission()
    {
        return view('user::admin.permissions.edit');
    }

    function postPermission()
    {

    }
}