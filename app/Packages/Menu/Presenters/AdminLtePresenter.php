<?php namespace Vain\Packages\Menu\Presenters;

class AdminLtePresenter implements PresenterInterface
{
    /**
     * @var
     */
    protected $instance;

    /**
     * @var string
     */
    protected $rootName;

    /**
     * AdminLtePresenter constructor.
     * @param null $rootName
     */
    public function __construct($rootName = null)
    {
        $this->rootName = $rootName;
    }

    /**
     * is used to push some default nodes into
     * the menu if necessary
     *
     * @param $instance
     */
    public function init($instance)
    {
        $this->instance = $instance;

        if ($this->rootName !== null)
        {
            $this->instance->raw(sprintf('<li class="header">%s</li>', $this->rootName));
        }
    }

    /**
     * this will setup the markup for the backend menu in AdminLTE style
     *
     * @return void
     */
    public function setup()
    {
        $this->instance->addClass('sidebar-menu');

        $this->instance->getItemsAtDepth(0)
            ->addClass('treeview');

        $this->instance->getItemListsAtDepth(1)
            ->addClass('treeview-menu');
    }
}