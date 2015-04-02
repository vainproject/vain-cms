<?php namespace Modules\Site\Handlers\Events;

use Modules\Site\Entities\Page;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class SiteMenuComposer {

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('site::admin.title.index')
            ->setUri(route('site.admin.sites.index'))
            ->setExtra('icon', 'file-o');
    }

    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        $event->handler->addChild('site::page.index')
            ->setUri('#');

        foreach (Page::published()->get() as $page)
        {
            $event->handler['site::page.index']->addChild($page->slug)
                ->setLabel($page->content->title)
                ->setUri(route('site.show', [ 'slug' => $page->slug ]))
                ->setExtra('raw', true);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('Vain\Events\BackendMenuCreated', 'Modules\Site\Handlers\Events\SiteMenuComposer@composeBackendMenu');

        $events->listen('Vain\Events\FrontendMenuCreated', 'Modules\Site\Handlers\Events\SiteMenuComposer@composeFrontendMenu');
    }
}