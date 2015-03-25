<?php namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Modules\User\Entities\User;
use Modules\User\Services\Registrar;
use Modules\User\Services\Updater;
use Vain\Http\Controllers\Controller;

class UserController extends Controller {

    public function getIndex()
    {
        $users = User::paginate();

        return view('user::admin.users.index')
            ->with('users', $users);
    }

    public function getCreate()
    {
        return view('user::admin.users.add');
    }

    public function postCreate(Request $request, Registrar $registrar)
    {
        $validator = $registrar->validator($request->all());

        if ($validator->fails())
        {
            return redirect()->route('user.admin.users.add')
                ->withErrors($validator);
        }

        $registrar->create($request->all());

        return $this->createDefaultResponse($request);
    }

    public function getUser($id)
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

    public function postUser(Request $request, Updater $updater, $id)
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

        return $this->createDefaultResponse($request);
    }

    public function deleteUser(Request $request, $id)
    {
        if ($id == $request->user()->id)
        {
            throw new InvalidArgumentException;
        }

        /** @var User $user */
        User::find($id)->delete();

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
            return response()->create('', 200);
        }

        return redirect()->route('user.admin.users.index');
    }
}