<?php

namespace Modules\Menu\Contracts;

interface MenuItemInterface
{
    const URL_EMPTY = '#';

    const TYPE_ROUTE = 1;

    const TYPE_URL = 2;

    /**
     * Boolean value whenever the menu item has
     * children or not.
     *
     * @return bool
     */
    public function hasChildren();

    /**
     * Boolean value whenever the menu item
     * contains inconsistend or wrong data.
     * i.e. a wrong route name.
     *
     * @return bool
     */
    public function isFaulty();

    /**
     * @param $value
     *
     * @return array
     */
    public function getParametersAttribute($value);

    /**
     * @param $value
     *
     * @return void
     */
    public function setParametersAttribute($value);

    /**
     * Localized string which represents the
     * type of the menu item.
     *
     * @param $value
     *
     * @return string
     */
    public function getActionAttribute($value);

    /**
     * Builds the targeting url based upon the given
     * type if the current item.
     *
     * @param $value
     *
     * @return string
     */
    public function getUrlAttribute($value);
}
