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

    public function getCreate()
    {
        return view('user::admin.permissions.create');
    }

    public function postCreate()
    {

    }

    public function getPermission()
    {
        return view('user::admin.permissions.edit');
    }

    public function postPermission()
    {

    }

    public function deleteUser($id)
    {
        Permission::find($id)->delete();
    }
}