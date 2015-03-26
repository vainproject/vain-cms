<?php namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\User\Entities\Permission;
use Modules\User\Http\Requests\PermissionFormRequest;
use Vain\Http\Controllers\Controller;

class PermissionController extends Controller {

    function getIndex()
    {
        $permissions = Permission::paginate();

        return view('user::admin.permissions.index')
            ->with('permissions', $permissions);
    }

    public function getCreate()
    {
        return view('user::admin.permissions.create');
    }

    public function postCreate(PermissionFormRequest $request)
    {
        Permission::create($request->all());

        return $this->createDefaultResponse($request);
    }

    public function getPermission($id)
    {
        $permission = Permission::find($id);

        return view('user::admin.permissions.edit')
            ->with('permission', $permission);
    }

    public function postPermission(PermissionFormRequest $request, $id)
    {
        $permission = Permission::find($id);

        $permission->fill($request->all());
        $permission->save();

        return $this->createDefaultResponse($request);
    }

    public function deletePermission(Request $request, $id)
    {
        // todo protect system permissions?

        Permission::find($id)->delete();

        return $this->createDefaultResponse($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse($request)
    {
        if ($request->ajax()) {
            // very default response, we basicly just need the response code
            return response('', 200);
        }

        return redirect()->route('user.admin.permissions.index');
    }
}