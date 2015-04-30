<?php namespace Modules\Premium\Handlers\Events;

use Modules\Site\Entities\Page;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class PremiumMenuComposer {

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('premium::premium.title.menu')
            ->setUri('#')
            ->setExtra('icon', 'shopping-cart');

        $event->handler['premium::premium.title.menu']->addChild('premium::premium.title.dashboard')
            ->setUri(route('premium.admin.premium.index'))
            ->setExtra('icon', 'circle-o');
    }

    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('Vain\Events\BackendMenuCreated', 'Modules\Premium\Handlers\Events\PremiumMenuComposer@composeBackendMenu');

        $events->listen('Vain\Events\FrontendMenuCreated', 'Modules\Premium\Handlers\Events\PremiumMenuComposer@composeFrontendMenu');
    }
}
