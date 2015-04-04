<?php namespace Modules\Blog\Handlers\Events;

use Modules\Blog\Entities\Category;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class BlogMenuComposer
{
    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        $event->handler->addChild('blog::blog.index')
            ->setUri(route('blog.post.index'));
    }

    /**
     * @param FrontendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('blog::blog.index')
            ->setUri(route('blog.post.index'));
    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Vain\Events\FrontendMenuCreated', 'Modules\Blog\Handlers\Events\BlogMenuComposer@composeFrontendMenu');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Blog\Handlers\Events\BlogMenuComposer@composeBackendMenu');
    }
}
