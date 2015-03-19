<?php namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Services\Updater;
use Vain\Packages\RealmAPI\EmulatorFactory;

class UserController extends Controller {

    protected $updater;

    function __construct(Updater $updater)
    {
        $this->updater = $updater;

        #$this->middleware('ajax', ['only' => 'postEdit']);
    }

    public function getProfile($id)
    {
        /** @var User $user */
        $user = User::find($id);

        return view('user::profile.index')
            ->with('user', $user);
    }

    public function getEdit(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $genders = [
            null => trans('user::profile.gender.none'),
            'male' => trans('user::profile.gender.male'),
            'female' => trans('user::profile.gender.female')
        ];

        $locales = config('app.locales');

        return view('user::profile.edit')
            ->with(['user' => $user, 'genders' => $genders, 'locales' => $locales]);
    }

    public function postEdit(Request $request)
    {
        $validator = $this->updater->validator($request->user(), $request->all());

        if ($validator->fails())
        {
            return redirect(route('user.profile.edit'))
                ->withErrors($validator);
        }

        $success = $this->updater->update($request->user(), $request->all());

        return new JsonResponse([ 'error' => !$success ]);
    }

    public function getAdmin(Request $request)
    {
        return view('user::admin.index');
    }

    public function getRealm(EmulatorFactory $factory)
    {
        $status =  $factory->connection('mangos')->getServerStatus();

        return new JsonResponse($status);
    }
}