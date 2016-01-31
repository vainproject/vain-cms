<?php

namespace Modules\Menu\Policies;

use Modules\Menu\Entities\Menu;
use Modules\User\Entities\User;
use Vain\Policies\Policy;

class MenuPolicy extends Policy
{
    /**
     * @param User $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function show($user, $menu)
    {
        // maybe handle specific role access here later?

        return true;
    }

    /**
     * @param User $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function edit($user, $menu)
    {
        return $user->can('menu.item.edit');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function create($user)
    {
        return $user->can('menu.item.create');
    }

    /**
     * @param User $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function destroy($user, $menu)
    {
        return $user->can('menu.item.destroy');
    }
}
