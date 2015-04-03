<?php namespace Modules\Blog\Handlers\Events;

use Modules\Blog\Entities\Category;
use Vain\Handlers\Events\MenuComposer as EventHandler;

class BlogMenuComposer extends EventHandler
{

    /**
     * @return void
     */
    protected function composeBackendMenu()
    {

    }

    /**
     * @return void
     */
    protected function composeFrontendMenu()
    {
        $this->handler->addChild('blog::blog.index')
            ->setUri(route('blog.index'));
    }
}
