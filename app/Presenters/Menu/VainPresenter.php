<?php namespace Vain\Presenters\Menu;

use Dowilcox\KnpMenu\Facades\Menu;
use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\ListRenderer;

class VainPresenter extends ListRenderer
{
    /**
     * set the default matcher so wo dont need an
     * parent ctor argument
     */
    function __construct()
    {
        $matcher = Menu::getMatcher();

        parent::__construct($matcher);
    }
}