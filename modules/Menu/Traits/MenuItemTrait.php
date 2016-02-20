<?php

namespace Modules\Menu\Traits;

use Exception;
use Modules\Menu\Contracts\MenuItemInterface as MenuItemContract;

trait MenuItemTrait
{
    /**
     * Boolean value whenever the menu item has
     * children or not.
     *
     * @return bool
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * Boolean value whenever the menu item
     * contains inconsistend or wrong data.
     * i.e. a wrong route name.
     *
     * @return bool
     */
    public function isFaulty()
    {
        return $this->url === null;
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function getParametersAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     */
    public function setParametersAttribute($value)
    {
        $this->attributes['parameters'] = json_encode($value);
    }

    /**
     * Localized string which represents the
     * type of the menu item.
     *
     * @param $value
     *
     * @return string
     */
    public function getActionAttribute($value)
    {
        switch ($this->type) {
            case MenuItemContract::TYPE_ROUTE:
                return trans('menu::menu.type.route');

            case MenuItemContract::TYPE_URL:
                return trans('menu::menu.type.url');

            default:
                return trans('menu::menu.type.unknown');
        }
    }

    /**
     * Builds the targeting url based upon the given
     * type if the current item.
     *
     * @param $value
     *
     * @return string
     */
    public function getUrlAttribute($value)
    {
        if ($this->hasChildren()) {
            return MenuItemContract::URL_EMPTY;
        }

        switch ($this->type) {
            case MenuItemContract::TYPE_ROUTE:
                return $this->routeGracefulOnError($this->target, $this->parameters);

            case MenuItemContract::TYPE_URL:
                return $this->target;

            default:
                return;
        }
    }

    /**
     * @param $name
     * @param $parameters
     *
     * @throws Exception
     *
     * @return null|string
     */
    private function routeGracefulOnError($name, $parameters)
    {
        try {
            return route($name, $parameters);
        } catch (Exception $exception) {
            return;
        }
    }
}
