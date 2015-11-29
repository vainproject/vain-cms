<?php namespace Modules\Menu\Listeners;

use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class MenuComposer
{
    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        //
    }

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('site::page.title.index')
            ->setExtra('patterns', ['/site\.admin\.sites\.(.+)/'])
            ->setUri(route('site.admin.sites.index'))
            ->setExtra('icon', 'bars');
    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Vain\Events\FrontendMenuCreated', 'Modules\Menu\Listeners\MenuComposer@composeFrontendMenu');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Menu\Listeners\MenuComposer@composeBackendMenu');
    }
}
