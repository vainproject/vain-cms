<?php namespace Modules\Blog\Policies;

use Modules\User\Entities\User;

class CategoryPolicy
{

    public function index(User $user)
    {
        return $user->can('blog.category.show');
    }

    public function show(User $user)
    {
        return $this->index($user);
    }

    public function edit(User $user)
    {
        return $user->can('blog.category.edit');
    }

    public function create(User $user)
    {
        return $user->can('blog.category.create');
    }

    public function destroy(User $user)
    {
        return $user->can('blog.category.destroy');
    }
}