<?php namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\Role;
use Vain\Http\Controllers\Controller;

class RoleController extends Controller {

    public function getIndex()
    {
        $roles = Role::paginate();

        return view('user::admin.roles.index')
            ->with('roles', $roles);
    }

    public function getCreate()
    {
        return view('user::admin.role.create');
    }

    public function postCreate()
    {

    }

    public function getRole()
    {
        return view('user::admin.role.edit');
    }

    public function postRole()
    {

    }

    public function deleteRole($id)
    {
        Role::find($id)->delete();
    }
}