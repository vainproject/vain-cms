<?php namespace Modules\User\Handlers\Events;

use Vain\Handlers\Events\MenuComposer as EventHandler;

class UserMenuComposer extends EventHandler {

    /**
     * @return void
     */
    protected function composeBackendMenu()
    {
        $this->handler->addChild('user.admin')
            ->setUri('#')
            ->setLabel('user::user.title.index')
            ->setExtra('icon', 'users');

        $this->handler['user.admin']->addChild('user::user.title.index')
            ->setUri(route('user.admin.users.index'))
            ->setExtra('icon', 'circle-o');

        $this->handler['user.admin']->addChild('user::role.title.index')
            ->setUri(route('user.admin.roles.index'))
            ->setExtra('icon', 'circle-o');

        $this->handler['user.admin']->addChild('user::permission.title.index')
            ->setUri(route('user.admin.permissions.index'))
            ->setExtra('icon', 'circle-o');
    }

    /**
     * @return void
     */
    protected function composeFrontendMenu()
    {

    }
}
