<?php

return [

   /*
   |--------------------------------------------------------------------------
   | Overwrite flag
   |--------------------------------------------------------------------------
   |
   | This option allow to specify whenever the menu delivered by this module
   | should overwrite the default menu injected by each module itself. If
   | set to false the menu items from this module will be appended.
   |
   */

    'overwrite' => true,

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
        'enable'  => false,
        'key'     => 'menu',
        'minutes' => 60,
    ],
];
