<?php namespace Modules\Blog\Policies;

use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\User\Entities\User;

class CommentPolicy {

    /** @var PostPolicy */
    private $postPolicy;

    function __construct(PostPolicy $postPolicy)
    {
        $this->postPolicy = $postPolicy;
    }

    public function create(User $user, Post $post)
    {
        return $this->postPolicy->create($user, $post)
            && $user->can('blog.comment.edit');
    }

    public function edit(User $user, Comment $comment)
    {
        return $this->postPolicy->show($user, $comment->post)
            || $user->owns($comment)
            || $user->can('blog.comment.edit');
    }

    public function destroy(User $user, Comment $comment)
    {
        return $this->postPolicy->show($user, $comment->post)
            || $user->owns($comment)
            || $user->can('blog.comment.destroy');
    }
}