<?php namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\User\Entities\Permission;
use Modules\User\Http\Requests\PermissionFormRequest;
use Vain\Http\Controllers\Controller;

class PermissionController extends Controller {

    function __construct()
    {
        // protect the modifying logic from executing
        // we do not wan't a change in permissions since they
        // only should be modified from module migrations

        $this->middleware('lockdown', [ 'except' => 'index' ]);

        $this->beforeFilter('permission:user.permission.show', ['only' => ['index', 'show']]);
        $this->beforeFilter('permission:user.permission.create', ['only' => ['create', 'store']]);
        $this->beforeFilter('permission:user.permission.edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('permission:user.permission.destroy', ['only' => 'destroy']);
    }

    function index()
    {
        $permissions = Permission::paginate();

        return view('user::admin.permissions.index')
            ->with('permissions', $permissions);
    }

    public function create()
    {
        return view('user::admin.permissions.create');
    }

    public function store(PermissionFormRequest $request)
    {
        Permission::create($request->all());

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('user::admin.permissions.edit')
            ->with('permission', $permission);
    }

    public function update(PermissionFormRequest $request, $id)
    {
        $permission = Permission::find($id);

        $permission->fill($request->all());
        $permission->save();

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
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