<?php namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;

class UserController extends Controller {

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

        return view('user::profile.edit')
            ->with('user', $user);
    }

    public function postEdit(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $user->update(
            $request->only($user->fillable)
        );

        return new JsonResponse([ 'error' => false ]);
    }
}