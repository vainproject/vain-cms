<?php namespace Modules\Site\Handlers\Events;

use Modules\Site\Entities\Page;
use Vain\Handlers\Events\MenuComposer as EventHandler;

class SiteMenuComposer extends EventHandler {

    /**
     * @return void
     */
    protected function composeBackendMenu()
    {
        $this->handler->addChild('site::admin.title')
            ->setUri(route('site.admin.sites.index'))
            ->setExtra('icon', 'file-o');
    }

    /**
     * @return void
     */
    protected function composeFrontendMenu()
    {
        foreach (Page::published()->get() as $page)
        {
            $this->handler->addChild($page->slug)
                ->setLabel($page->content->title)
                ->setUri(route('site.show', [ 'slug' => $page->slug ]))
                ->setExtra('raw', true);
        }
    }
}
