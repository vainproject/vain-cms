<?php namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\Role;
use Vain\Http\Controllers\Controller;

class RoleController extends Controller {

    function getIndex()
    {
        $roles = Role::paginate();

        return view('user::admin.roles.index')
            ->with('roles', $roles);
    }

    function getAdd()
    {

    }

    function postAdd()
    {

    }

    function getRole()
    {

    }

    function postRole()
    {

    }
}