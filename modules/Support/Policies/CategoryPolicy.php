<?php namespace Modules\Support\Policies;

use Modules\Support\Entities\Category;
use Modules\User\Entities\User;

class CategoryPolicy {

    public function index(User $user)
    {
        return $user->can('support.category.show');
    }

    public function show(User $user)
    {
        return $this->index($user);
    }

    public function create(User $user)
    {
        return $user->can('support.category.create');
    }

    public function edit(User $user, Category $category)
    {
        return $user->owns($category)
            || $user->can('support.category.edit');
    }

    public function destroy(User $user, Category $category)
    {
        return $user->owns($category)
            || $user->can('support.category.destroy');
    }
}