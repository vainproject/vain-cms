<?php

return [
    'title' => [
        'index' => 'Blog',
        'post' => 'Blog: :name'
    ],
    'index' => 'Blog',
    'comment' => [
        'save' => [
            'error' => 'An error occurred while trying to store your comment',
            'success' => 'Comment successfully created',
            'button' => 'Comment'
        ],
        'delete' => [
            'error' => 'Error when trying to delete the comment',
            'success' => 'Comment successfully deleted'
        ],
        'write' => 'Write new comment',
        'placeholder' => 'Now it\'s time for your comment...',
        'count' => ':count Comment so far|:count Comments so far',
        'credits' => 'posted vor :time von',
    ]
];