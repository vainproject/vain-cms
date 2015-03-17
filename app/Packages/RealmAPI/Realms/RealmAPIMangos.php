<?php namespace Vain\Packages\RealmAPI\Realms;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 26.01.2015
 * Time: 21:00
 */

use Vain\Packages\RealmAPI\RealmAPI;
use Illuminate\Support\Facades\Cache;

class RealmAPIMangos extends RealmAPI
{

    public function __construct($useCache = true)
    {
        parent::__construct(RealmAPI::REALM_MANGOS, $useCache);
    }

    /**
     * Get information about running realm (player online, uptime, ...)
     * @return array
     */
    public function getServerStatus() // ToDo: rather use a db query?
    {
        $key = 'getServerStatus-' . $this->id;
        if ($this->useCache && Cache::has($key)) return Cache::get($key);

        if (!($string = $this->send('server info')))
            return null;

        $format = "Anzahl der verbundenen Spieler: %d (Maximum: %d) Spieler in der Warteschlange: %d (Maximum: %d)";
        $data = array_combine(['online', 'maximum', 'queue', 'queueMaximum'], sscanf($string, $format));
        Cache::put($key, $data, 1);

        return $data;
    }

    /**
     * Send an item to a player
     * @param $guid Integer
     * @param $item Integer
     * @returns boolean
     */
    public function sendItem($guid, $item) // ToDo: might be the same syntax for trinity
    {
        return is_null($this->send('send items "RG Premium System" "" ' . $item));
    }

}
