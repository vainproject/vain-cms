<?php namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\Permission;
use Vain\Http\Controllers\Controller;

class PermissionController extends Controller {

    function __construct()
    {
        // we do not wan't a change in permissions since they
        // only should be modified from module migrations

        $this->beforeFilter('permission:user.permission.show');
    }

    function index()
    {
        $permissions = Permission::paginate();

        return view('user::admin.permissions.index')
            ->with('permissions', $permissions);
    }
}