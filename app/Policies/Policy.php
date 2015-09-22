<?php namespace Vain\Policies;

use Modules\User\Entities\User;

abstract class Policy
{
    /**
     * @param User $user
     * @param string $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        // this will basicly prefent from erroring if a policy is resolved via helper
        // methods and called directly without authenticated user
        if ($user == null) {
            return false;
        }
    }
}