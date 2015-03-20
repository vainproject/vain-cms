<?php namespace Vain\Packages\RealmAPI;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 26.01.2015
 * Time: 21:00
 */

class TrinityEmulator extends AbstractEmulator
{
    /**
     * Get information about running realm (player online, uptime, ...)
     * @return array
     */
    public function getServerStatus()
    {
        throw new \BadFunctionCallException();
    }

    /**
     * Send an item/s to a player
     * @param string $name
     * @param array|int $items
     * @returns boolean
     */
    public function sendItems($name, $items)
    {
        $itemString = '';
        if (is_array($items)) {
            $prefix = '';
            foreach ($items as $item) {
                $itemString .= $prefix . $item;
                $prefix = ' ';
            }
        } else
            $itemString = $items;

        return $this->soap->send('send items '.$name.' "RG Premium System" "" ' . $itemString) !== false;
    }
}
