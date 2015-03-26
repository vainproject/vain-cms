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
     * Create a new event instance.
     *
     * @param MenuItem $handler
     * @param string $name
     * @param View $view
     */
	public function __construct(MenuItem $handler, $name, View $view)
	{
		$this->handler = $handler;
        $this->name = $name;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }
}
