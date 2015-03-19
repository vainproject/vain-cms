<?php

namespace spec\Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class RegistrarSpec extends LaravelObjectBehavior
{
    function let()
    {
        DB::beginTransaction();
    }

    function letGo()
    {
        DB::rollBack();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Modules\User\Services\Registrar');
    }

    function it_conforms_to_registrar_contract()
    {
        $this->shouldImplement('Illuminate\Contracts\Auth\Registrar');
    }

    function it_builds_validator()
    {
        $this->validator([])
            ->shouldHaveType('Illuminate\Validation\Validator');
    }

    function it_validates_correctly_with_invalid_data()
    {
        $invalid_data = [];

        $this->validator($invalid_data)
            ->fails()
            ->shouldReturn(true);
    }

    function it_validates_correctly_with_valid_data()
    {
        $valid_data = [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->validator($valid_data)
            ->passes()
            ->shouldReturn(true);
    }

    function it_creates_user()
    {
        $valid_data = [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $user = $this->create($valid_data)
            ->shouldHaveType('Modules\User\Entities\User');

        User::findOrFail($user->id); // never test an object out of object behavior directly!
    }
}
