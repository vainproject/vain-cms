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

        parent::__construct($matcher, $options);
    }

    /**
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    public function render(ItemInterface $item, array $options = [])
    {
        $this->renderRootElement($item, $options);

        return parent::render($item, $options);
    }

    /**
     * @param ItemInterface $item
     * @param array $options
     */
    protected function renderRootElement(ItemInterface $item, array $options = [])
    {
        $class = explode(' ', $item->getChildrenAttribute('class', ''));
        $class[] = 'nav navbar-nav';

        $item->setChildrenAttribute('class', implode(' ', $class)); // add base class
    }

    /**
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    protected function renderItem(ItemInterface $item, array $options)
    {
        // if we don't have access or this item is marked to not be shown
        if (!$item->isDisplayed()) {
            return '';
        }

        // create an array than can be imploded as a class list
        $class = (array)$item->getAttribute('class');

        if ($this->matcher->isCurrent($item)
            || $this->matcher->isAncestor($item, $options['matchingDepth'])
        ) {
            $class[] = $options['currentClass'];
        }

        if ($item->hasChildren()) {
            $class[] = 'dropdown';
        }

        // retrieve the attributes and put the final class string back on it
        $attributes = $item->getAttributes();
        if (!empty($class)) {
            $attributes['class'] = implode(' ', $class);
        }

        // opening li tag
        $html = $this->format(
            '<li' . $this->renderHtmlAttributes($attributes) . '>',
            'li',
            $item->getLevel(),
            $options
        );

        // render the text/link inside the li tag
        //$html .= $this->format($item->getUri() ? $item->renderLink() : $item->renderLabel(), 'link', $item->getLevel());
        if ($item->hasChildren()) {
            $item->setLinkAttribute('class', 'dropdown-toggle');
            $item->setLinkAttribute('data-toggle', 'dropdown');
        }
        $html .= $this->renderLink($item, $options);

        // renders the embedded ul
        $childrenClass = (array)$item->getChildrenAttribute('class');
        $childrenClass[] = 'dropdown-menu';

        $childrenAttributes = $item->getChildrenAttributes();
        $childrenAttributes['class'] = implode(' ', $childrenClass);

        $html .= $this->renderList($item, $childrenAttributes, $options);

        // closing li tag
        $html .= $this->format('</li>', 'li', $item->getLevel(), $options);

        return $html;
    }

    /**
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    protected function renderLinkElement(ItemInterface $item, array $options)
    {
        return sprintf(
            '<a href="%s"%s>%s %s</a>',
            $this->escape($item->getUri()),
            $this->renderHtmlAttributes($item->getLinkAttributes()),
            $this->renderLabel($item, $options),
            $this->renderFolding($item, $options)
        );
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

        if ($item->getExtra('raw', false) !== false) {
            return $this->escape($item->getLabel());
        }

        return $this->escape(trans($item->getLabel()));
    }

    /**
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    protected function renderFolding(ItemInterface $item, array $options = [])
    {
        if ($item->hasChildren()) {
            return $this->renderFoldingElement($item, $options);
        }

        return '';
    }

    /**
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    protected function renderFoldingElement(ItemInterface $item, array $options = [])
    {
        return '<span class="caret"></span>';
    }
}