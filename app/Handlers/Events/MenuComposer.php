<?php namespace Vain\Handlers\Events;

use Vain\Events\MenuHandlerWasCreated;

abstract class MenuComposer {

    /**
     * the menu handler
     *
     * @var MenuItem
     */
    protected $handler;

    /**
     * name of the view
     *
     * @var string
     */
    protected $name;

    /**
     * the view itself
     *
     * @var View
     */
    protected $view;

    /**
     * @return void
     */
    abstract protected function composeBackendMenu();

    /**
     * @return void
     */
    abstract protected function composeFrontendMenu();

    /**
     * Handle the event.
     *
     * @param MenuHandlerWasCreated $event
     */
    public function handle(MenuHandlerWasCreated $event)
    {
        $this->handler = $event->getHandler();
        $this->name = $event->getName();
        $this->view = $event->getView();

        $this->invokeCompose();
    }

    /**
     * calls menu composer
     */
    private function invokeCompose()
    {
        if ($this->name === 'app')
        {
            $this->composeFrontendMenu();
        }
        else
        {
            $this->composeBackendMenu();
        }
    }
}
