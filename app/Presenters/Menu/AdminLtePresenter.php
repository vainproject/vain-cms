<?php namespace Vain\Presenters\Menu;

use Dowilcox\KnpMenu\Facades\Menu;
use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\ListRenderer;

class AdminLtePresenter extends ListRenderer
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


    /**
     * Renders menu tree.
     *
     * Common options:
     *      - depth: The depth at which the item is rendered
     *          null: no limit
     *          0: no children
     *          1: only direct children
     *      - currentAsLink: whether the current item should be a link
     *      - currentClass: class added to the current item
     *      - ancestorClass: class added to the ancestors of the current item
     *      - firstClass: class added to the first child
     *      - lastClass: class added to the last child
     *
     * @param ItemInterface $item Menu item
     * @param array $options some rendering options
     *
     * @return string
     */
//    public function render( ItemInterface $item, array $options = array() )
//    {
//        // TODO: Implement render() method.
//    }
}