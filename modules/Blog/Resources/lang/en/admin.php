<?php

return [
    'title' => [
        'index' => 'Blog',
        'posts' => 'Posts',
        'categories' => 'Categories'
    ],
    'posts' => [
        'field' => [
            'id' => '#',
            'slug' => 'Slug',
            'author' => 'Author',
            'created_at' => 'Created',
            'published_at' => 'Published',
            'concealed_at' => 'Hide'
        ],
        'action' => [
            'confirm' => 'Confirm',
            'abort' => 'Cancel',
            'destroy' => 'Delete',
            'edit' => 'Edit',
            'save' => 'Save'
        ],
        'delete' => [
            'message' => 'Do you really want to delete this post?',
            'success' => 'The post has successfully been deleted.',
            'error' => 'An error occurred while trying to delete the post.'
        ],
        'section' => [
            'general' => 'General information'
        ]
    ]
];