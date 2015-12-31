<?php

namespace Modules\Menu\Events;

use Illuminate\Queue\SerializesModels;
use Knp\Menu\MenuItem;
use Modules\Menu\Services\MenuItemBuilder;
use Vain\Events\Event;

class PostMenuSetup extends Event
{
    use SerializesModels;

    /**
     * the menu handler.
     *
     * @var MenuItem
     */
    public $handler;

    /**
     * @var MenuItemBuilder
     */
    public $builder;

    /**
     * Create a new event instance.
     *
     * @param MenuItem        $handler
     * @param MenuItemBuilder $builder
     */
    public function __construct(MenuItem $handler, MenuItemBuilder $builder)
    {
        $this->handler = $handler;
        $this->builder = $builder;
    }
}
