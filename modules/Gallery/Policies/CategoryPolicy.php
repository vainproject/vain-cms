<?php namespace Modules\Gallery\Policies;

use Modules\User\Entities\User;
use Vain\Policies\Policy;

class CategoryPolicy extends Policy
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function index($user)
    {
        return $user->can('gallery.category.show');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function show($user)
    {
        return $this->index($user);
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function edit($user)
    {
        return $user->can('gallery.category.edit');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function create($user)
    {
        return $user->can('gallery.category.create');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function destroy($user)
    {
        return $user->can('gallery.category.destroy');
    }

}