<?php

return [
    'title' => [
        'index'  => 'Menu',
        'show'   => 'Menu entry :title',
        'edit'   => 'Edit menu entry',
        'create' => 'Create menu entry',
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
        'id'           => '#',
        'target'       => 'Target',
        'type'         => [
            'unknown'  => 'Unknown',
            'route'    => 'Route',
            'extern'   => 'External',
        ],
        'title'        => 'Title',
        'description'  => 'Description',
        'published_at' => 'Published at',
        'concealed_at' => 'Concealed at',
        'created_at'   => 'Created at',
        'updated_at'   => 'Updated at',
    ],
    'error' => [
        'broken' => 'The hyperlink is faulty, please check the configuration.',
    ],
    'section' => [
        'general' => 'General',
        'dates'   => 'Time designation',
    ],
    'delete'    => [
        'message' => 'Do you really want to delete the selected menu items?',
        'success' => 'Menu item has been deleted!',
        'error'   => 'Menu item was not deleted!',
    ],
    'save' => [
        'success' => 'Menu item has been saved!',
        'error'   => 'Menu item has not been saved!',
    ],
];
