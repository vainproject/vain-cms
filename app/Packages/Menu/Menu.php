<?php namespace Vain\Packages\Menu;

use Menu\Menu as MenuContainer;
use Vain\Packages\Menu\Presenters\PresenterInterface;

class Menu {

    /**
     * @var PresenterInterface[]
     */
    protected $presenters;

    /**
     * Menu constructor.
     */
    public function __construct()
    {
        $this->presenters = [];
    }

    /**
     * registers and initializes a presenter
     *
     * @param $name
     * @param $presenter
     * @return $this
     */
    public function registerPresenter($name, $presenter)
    {
        $presenter->init($this->handler($name));

        $this->presenters[ $name ] = $presenter;

        return $this;
    }

    /**
     * @param $name
     * @return \Menu\MenuHandler
     */
    public function handler($name)
    {
        return MenuContainer::handler($name);
    }

    /**
     * @return \Menu\Items\ItemList
     */
    public function items()
    {
        return MenuContainer::items();
    }

    /**
     * renders the menu to html
     * use it in views
     *
     * @param $name
     * @return string
     */
    public function render($name)
    {
        $this->present($name);

        return $this->handler($name)->render();
    }

    /**
     * changes rendering to match the frontend
     * this is done by the presenter
     *
     * @param $name
     */
    protected function present($name)
    {
        if (array_key_exists($name, $this->presenters))
        {
            $this->presenters[ $name ]->setup();
        }
    }
}