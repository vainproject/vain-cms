<?php namespace Modules\User\Services;

use Modules\User\Entities\User;
use Validator;

class Updater {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param User $user
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(User $user, array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => sprintf('required|email|max:255|unique:users,email,%d', $user->id),
            'password' => 'confirmed|min:6',
        ]);
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function update(User $user, array $data)
    {
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        // only fill password if specified
        if (array_key_exists('password', $data)
            && !empty($data['password']))
        {
            $user->fill([
                'password' => bcrypt($data['password'])
            ]);
        }

        return $user->save();
    }
}
