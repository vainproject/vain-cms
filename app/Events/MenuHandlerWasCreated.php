<?php namespace Vain\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\View\View;
use Knp\Menu\MenuItem;

class MenuHandlerWasCreated extends Event {

	use SerializesModels;

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
     * Create a new event instance.
     *
     * @param MenuItem $handler
     * @param View $view
     */
	public function __construct(MenuItem $handler, View $view)
	{
		$this->handler = $handler;
        $this->view = $view;
	}

    /**
     * @return MenuItem
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }
}
