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
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('blog.admin')
            ->setUri('#')
            ->setLabel('blog::admin.title.index')
            ->setExtra('icon', 'newspaper-o')
            ->setUri(route('blog.post.index'));

        $event->handler['blog.admin']->addChild('blog::admin.title.posts')
            ->setUri(route('blog.admin.posts.index'))
            ->setExtra('icon', 'circle-o');

        $event->handler['blog.admin']->addChild('blog::admin.title.categories')
            ->setUri(route('blog.admin.categories.index'))
            ->setExtra('icon', 'circle-o');
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
