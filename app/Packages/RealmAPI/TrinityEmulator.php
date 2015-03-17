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
     * Send an item to a player
     * @param $guid Integer
     * @param $item Integer
     * @returns boolean
     */
    public function sendItem($guid, $item) // ToDo: might be the same syntax for trinity
    {
        throw new \BadFunctionCallException();
    }
}