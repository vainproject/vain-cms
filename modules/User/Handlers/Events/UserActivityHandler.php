<?php namespace Modules\User\Handlers\Events;

use Illuminate\View\View;
use Knp\Menu\MenuItem;
use Modules\User\Entities\User;

class UserActivityHandler {

    /**
     * the menu handler
     *
     * @var MenuItem
     */
    protected $handler;

    /**
     * the view itself
     *
     * @var View
     */
    protected $view;

    /**
     * Handle user login events.
     *
     * @param User $user
     */
    public function onUserLogin(User $user)
    {
        $user->logged_out = false;

        $user->timestamps = false; // don't update updated_at
        $user->save();
    }

    /**
     * Handle user logout events.
     *
     * @param User $user
     */
    public function onUserLogout(User $user)
    {
        $user->logged_out = true;

        $user->timestamps = false; // don't update updated_at
        $user->save();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('auth.login', 'Modules\User\Handlers\Events\UserActivityHandler@onUserLogin');

        $events->listen('auth.logout', 'Modules\User\Handlers\Events\UserActivityHandler@onUserLogout');
    }
}
