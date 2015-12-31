<?php

namespace Modules\Menu\Listeners;

use Illuminate\Support\Facades\Cache;
use Modules\Menu\Events\PostMenuSetup;
use Vain\Events\BackendMenuCreated;

class MenuComposer
{
    /**
     * @param PostMenuSetup $event
     */
    public function postMenuSetup(PostMenuSetup $event)
    {
        // clear all items at top level
        foreach ($event->handler->getChildren() as $child) {
            $event->handler->removeChild($child);
        }

        // inject own frontend menue
        $menu = $this->cacheIfConfigured(function () use ($event) {
            return $event->builder->getMenuItems();
        });

        foreach ($menu as $menuItem) {
            $event->handler->addChild($menuItem);
        }
    }

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('menu::menu.title.index')
            ->setExtra('patterns', ['/menu\.admin\.entries\.(.+)/'])
            ->setUri(route('menu.admin.items.index'))
            ->setExtra('icon', 'bars');
    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Modules\Menu\Events\PostMenuSetup', 'Modules\Menu\Listeners\MenuComposer@postMenuSetup');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Menu\Listeners\MenuComposer@composeBackendMenu');
    }

    /**
     * uses the cache if it was configured or calculates
     * the plain output every request otherwise.
     *
     * @param $closure
     *
     * @return array
     */
    private function cacheIfConfigured($closure)
    {
        if (config('menu.cache.enable')) {
            $key = config('menu.cache.key');
            $minutes = config('menu.cache.minutes');

            return Cache::remember($key, $minutes, function () use ($closure) {
                return call_user_func($closure);
            });
        }

        return call_user_func($closure);
    }
}
