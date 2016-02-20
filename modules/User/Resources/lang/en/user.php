<?php

return [
    'title' => [
        'menu'   => 'Users & Roles',
        'index'  => 'Users',
        'edit'   => 'Edit user',
        'create' => 'Create user',
    ],
    'action' => [
        'create'  => 'Create',
        'save'    => 'Save',
        'edit'    => 'Edit',
        'delete'  => 'Delete',
        'abort'   => 'Abort',
        'confirm' => 'Confirm',
    ],
    'field' => [
        'id'         => '#',
        'created_at' => 'Member since',
        'updated_at' => 'Updated',
    ],
    'section' => [
        'role' => 'Roles',
    ],
    'delete' => [
        'message'   => 'Do you really want to delete the selected user?',
        'success'   => 'User has been deleted!',
        'relations' => 'User is related to certain content. Please remove the content or decouple the relations.',
        'error'     => 'User has not been deleted!',
    ],
    'save' => [
        'success' => 'User has been saved!',
        'error'   => 'User has not been saved!',
    ],
];
