<?php namespace Modules\Blog\Policies;

use Modules\Blog\Entities\Post;
use Modules\User\Entities\User;

class PostPolicy
{

    public function index(User $user)
    {
        return $user->can('blog.post.show');
    }

    public function show(User $user, Post $post)
    {
        return $user->owns($post)
            || $this->index($user);
    }

    public function edit(User $user, Post $post)
    {
        return $user->owns($post)
            || $user->can('blog.post.edit');
    }

    public function create(User $user)
    {
        return $user->can('blog.post.create');
    }

    public function destroy(User $user, Post $post)
    {
        return $user->owns($post)
            || $user->can('blog.post.destroy');
    }
}