<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | All available locales should be listed here. They are prompted
    | to the user if he wants to change his current locale. The names
    | should be hardcoded native in each language.
    |
    */

    'locales' => [
        'de' => 'Deutsch',
        'en' => 'English',
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        /*
         * Custom package facades
         */
        'Debugbar'        => Barryvdh\Debugbar\Facade::class,
        'Socialize'       => Laravel\Socialite\Facades\Socialite::class,
        'LocalizedCarbon' => Laravelrus\LocalizedCarbon\LocalizedCarbon::class,
        'DiffFormatter'   => Laravelrus\LocalizedCarbon\DiffFactoryFacade::class,
        'Menu'            => Dowilcox\KnpMenu\Facades\Menu::class,
        'Form'            => Collective\Html\FormFacade::class,
        'Html'            => Collective\Html\HtmlFacade::class,
        'Breadcrumbs'     => DaveJamesMiller\Breadcrumbs\Facade::class,
    ],

];
