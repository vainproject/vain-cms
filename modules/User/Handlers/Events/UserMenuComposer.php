<?php namespace Modules\User\Handlers\Events;

use Vain\Events\BackendMenuCreated;

class UserMenuComposer {

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('user.admin')
            ->setUri('#')
            ->setLabel('user::user.title.index')
            ->setExtra('icon', 'users');

        $event->handler['user.admin']->addChild('user::user.title.index')
            ->setUri(route('user.admin.users.index'))
            ->setExtra('icon', 'circle-o');

        $event->handler['user.admin']->addChild('user::role.title.index')
            ->setUri(route('user.admin.roles.index'))
            ->setExtra('icon', 'circle-o');

        $event->handler['user.admin']->addChild('user::permission.title.index')
            ->setUri(route('user.admin.permissions.index'))
            ->setExtra('icon', 'circle-o');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('Vain\Events\BackendMenuCreated', 'Modules\User\Handlers\Events\UserMenuComposer@composeBackendMenu');
    }
}
