<?php namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Modules\User\Entities\User;
use Modules\User\Services\Registrar;
use Modules\User\Services\Updater;
use Vain\Http\Controllers\Controller;

class UserController extends Controller {

    function __construct()
    {
        $this->middleware('ajax', ['only' => 'deleteUser']);
    }

    function getIndex()
    {
        $users = User::paginate();

        return view('user::admin.users.index')
            ->with('users', $users);
    }

    function getAdd()
    {
        return view('user::admin.users.add');
    }

    function postAdd(Request $request, Registrar $registrar)
    {
        $validator = $registrar->validator($request->all());

        if ($validator->fails())
        {
            return redirect()->route('user.admin.users.add')
                ->withErrors($validator);
        }

        $registrar->create($request->all());

        return redirect()->route('user.admin.users.index');
    }

    function getUser($id)
    {
        /** @var User $user */
        $user = User::find($id);

        $genders = [
            null => trans('user::profile.gender.none'),
            'male' => trans('user::profile.gender.male'),
            'female' => trans('user::profile.gender.female')
        ];

        $locales = config('app.locales');

        return view('user::admin.users.edit')
            ->with(['user' => $user, 'genders' => $genders, 'locales' => $locales]);
    }

    function postUser(Request $request, Updater $updater, $id)
    {
        /** @var User $user */
        $user = User::find($id);

        $validator = $updater->validator($user, $request->all());

        if ($validator->fails())
        {
            return redirect()
                ->route('user.admin.users.edit')
                ->withErrors($validator);
        }

        $updater->update($user, $request->all());

        return redirect()->route('user.admin.users.index');
    }

    function deleteUser(Request $request, $id)
    {
        if ($id == $request->user()->id)
        {
            throw new InvalidArgumentException;
        }

        /** @var User $user */
        User::find($id)->delete();
    }
}