<?php namespace Modules\User\Handlers\Events;

use Illuminate\View\View;
use Knp\Menu\MenuItem;
use Vain\Events\BackendMenuCreated;

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
     * @param \App\Events\UserLoggedIn $event
     */
    public function onUserLogin($event)
    {
        //
    }

    /**
     * Handle user logout events.
     *
     * @param \App\Events\UserLoggedOut $event
     */
    public function onUserLogout($event)
    {
        //
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('App\Events\UserLoggedIn', 'Modules\User\Handlers\Events\UserActivityHandler@onUserLogin');

        $events->listen('App\Events\UserLoggedOut', 'Modules\User\Handlers\Events\UserActivityHandler@onUserLogout');
    }
}
