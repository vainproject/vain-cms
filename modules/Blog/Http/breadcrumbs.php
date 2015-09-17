<?php

use Modules\Blog\Entities\Post;

Breadcrumbs::register('blog.post.index', function ($breadcrumbs) {
    $breadcrumbs->parent('index.home');
    $breadcrumbs->push('Blog', route('blog.post.index'));
});

Breadcrumbs::register('blog.post.show', function ($breadcrumbs, $slug) {
    $post = Post::where('slug', $slug)->first();

    $breadcrumbs->parent('blog.post.index');
    $breadcrumbs->push($post->content->title, route('blog.post.show'));
});

