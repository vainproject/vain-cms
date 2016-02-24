<?php

namespace Modules\Gallery\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Gallery\Entities\Post;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class GalleryMenuComposer
{
    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
    }

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('gallery.admin')
            ->setUri('#')
            ->setLabel('gallery::admin.title')
            ->setExtra('icon', 'picture-o');

        $event->handler['gallery.admin']->addChild('gallery.admin.category')
            ->setUri(route('gallery.admin.category.index'))
            ->setLabel('gallery::admin.title.index')
            ->setExtra('icon', 'folder');
    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Vain\Events\FrontendMenuCreated', 'Modules\Gallery\Listeners\GalleryMenuComposer@composeFrontendMenu');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Gallery\Listeners\GalleryMenuComposer@composeBackendMenu');
    }
}
