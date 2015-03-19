<?php

namespace spec\Modules\User\Services;

use Illuminate\Support\Facades\DB;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdaterSpec extends ObjectBehavior
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
        $this->shouldHaveType('Modules\User\Services\Updater');
    }

    function it_builds_validator($user)
    {
        $user->beADoubleOf('Modules\User\Entities\User');

        $this->validator($user, [])
            ->shouldHaveType('Illuminate\Validation\Validator');
    }

    function it_validates_correctly_with_invalid_data($user)
    {
        $user->beADoubleOf('Modules\User\Entities\User');

        $invalid_data = [];

        $this->validator($user, $invalid_data)
            ->fails()
            ->shouldReturn(true);
    }

    function it_validates_correctly_with_valid_data($user)
    {
        $user->beADoubleOf('Modules\User\Entities\User');

        $valid_data = [
            'name' => 'Test Name',
            'alias' => 'tester',
            'email' => 'test@example.com',
        ];

        $this->validator($user, $valid_data)
            ->passes()
            ->shouldReturn(true);
    }

// TODO to fragile and dependent on the data array
//    function it_updates_user($user)
//    {
//        $user->beADoubleOf('Modules\User\Entities\User');
//
//        $valid_data = [
//            'name' => 'Test Name',
//            'email' => 'test@example.com',
//        ];
//
//        $user->fill($valid_data)
//            ->shouldBeCalled();
//
//        $user->save()
//            ->shouldBeCalled();
//
//        $this->update($user, $valid_data)
//            ->shouldBeNull(); // no true or false since we are in transaction
//    }
}
