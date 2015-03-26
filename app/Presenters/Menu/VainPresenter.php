<?php namespace Vain\Presenters\Menu;

use Dowilcox\KnpMenu\Facades\Menu;
use Illuminate\Support\Facades\Config;
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
        $options = Config::get('menu.render');

        parent::__construct( $matcher, $options );
    }

    /**
     * unless 'raw' extra isn't set to true, we try to translate the label
     *
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    protected function renderLabel(ItemInterface $item, array $options)
    {
        if ($options['allow_safe_labels'] && $item->getExtra('safe_label', false)) {
            return $item->getLabel();
        }

        if ($item->getExtra('raw', false) !== false)
        {
            return $this->escape($item->getLabel());
        }

        return $this->escape(trans($item->getLabel()));
    }
}