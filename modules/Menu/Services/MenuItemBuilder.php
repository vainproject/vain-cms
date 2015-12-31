<?php

namespace Modules\Menu\Services;

use Knp\Menu\MenuItem;
use Modules\Menu\Entities\Menu;
use Dowilcox\KnpMenu\Menu as MenuProvider;

class MenuItemBuilder {

    /**
     * @var \Knp\Menu\MenuFactory
     */
    public $factory;

    /**
     * MenuItemBuilder constructor.
     * @param MenuProvider $provider
     */
    public function __construct(MenuProvider $provider)
    {
        $this->factory = $provider->getFactory();
    }

    /**
     * @return array
     */
    public function getMenuItems()
    {
        $items = [];

        $roots = Menu::roots()->visible()->get();
        foreach ($roots as $item)
        {
            $parent = $this->createItem( $item->content->title )
                ->setExtra('patterns', $this->extractPattern($item))
                ->setUri($item->url);

            $this->attachChildren($item->children, $parent);

            $items[] = $parent;
        }

        return $items;
    }

    /**
     * @param $items
     * @param $parent
     * @return array
     */
    private function attachChildren($items, $parent = null)
    {
        foreach ($items as $item)
        {
            /** @var  $parent MenuItem */
            $parent = $parent->addChild( $item->content->title )
                ->setExtra('patterns', $this->extractPattern($item))
                ->setUri($item->url);

            return $this->attachChildren($item->children, $parent);
        }
    }

    /**
     * @param Menu $item
     * @return array
     */
    private function extractPattern($item)
    {
        $pattern = '';

        if ($item->type == Menu::TYPE_ROUTE)
        {
            $pattern = '/' . preg_quote($item->target) . '\.(.+)/';
        }

        return [$pattern];
    }

    /**
     * creates a new menu item
     *
     * @param $title
     * @return MenuItem
     */
    private function createItem($title)
    {
        return new MenuItem($title, $this->factory);
    }
}