<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | This option controls the caching behavior which will be utilized.
    | It is highly recommended to setup the cache properly in production
    | and especially if you use large menus with deep nesting.
    |
    */

    'cache' => [
        'enable' => false,
        'key' => 'menu',
        'minutes' => 60,
    ],
];