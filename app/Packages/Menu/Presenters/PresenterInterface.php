<?php namespace Vain\Packages\Menu\Presenters;

interface PresenterInterface
{
    /**
     * is used to push some default nodes into
     * the menu if necessary
     *
     * @param $instance
     */
    public function init($instance);

    /**
     * setup css classes and overall structure
     * to match the frontend framework
     *
     * @return void
     */
    public function setup();
}