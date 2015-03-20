<?php namespace Vain\Packages\RealmAPI;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 26.01.2015
 * Time: 20:36
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;
use Vain\Packages\RealmAPI\Models\Character;
use Vain\Packages\RealmAPI\Services\SoapService;

// TODO optimize general cache usage / less repeatative code?
abstract class AbstractEmulator
{
    use Configurator, Cacheable;

    const REALM_TRINITY = 1;

    const REALM_MANGOS = 2;

    /**
     * @var $realm string
     */
    protected $realm;

    /**
     * @var $type int
     */
    protected $type;

    /**
     * @var array
     */
    protected $connections;

    /**
     * @var $soap SoapService
     */
    protected $soap;

    /**
     * @param $realm
     * @param bool $useCache
     */
    public function __construct($realm, $useCache = true)
    {
        $this->realm = $realm;
        $this->useCache = $useCache;

        $this->type = $this->getTypeConfig($realm);
        $this->connections = $this->getDatabaseConfig($realm);

        $this->soap = app('Vain\Packages\RealmAPI\Services\SoapService')
            ->configure($this->getSoapConfig($realm));
    }


    /**
     * Get information about running realm (player online, uptime, ...)
     * @return array
     */
    public abstract function getServerStatus();

    /**
     * Send an item to a player
     * @param string $name
     * @param array|int $items
     * @returns bool
     */
    public abstract function sendItems($name, $items);

    // ToDo: some stuff that might be useful
    //public abstract function getAccountCharacters();
    //public abstract function sendMail();
    //public abstract function createAccount();
    //public abstract function announce($string);
    //public abstract function banAccount();
    //public abstract function characterCustomizeLook();
    //public abstract function muteAccount();

    /**
     * Returns the realm id
     *
     * @return int
     */
    public function getRealmType()
    {
        return $this->type;
    }

    /**
     * Get character name by GUID
     *
     * @param int $guid
     * @return String|null
     */
    public function getCharacterNameByGuid($guid)
    {
        $key = $this->cacheKey(__FUNCTION__, $guid);

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        $name = DB::connection($this->connections['world'])
            ->table('characters')
            ->where('guid', $guid)
            ->pluck('name');

        Cache::put($key, $name, $this->cacheDuration);

        return $name;
    }

    /**
     * Get GUID by character name
     * @param string $name
     * @return int|null
     */
    public function getCharacterGuidByName($name)
    {
        $key = $this->cacheKey(__FUNCTION__, $name);

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        $guid = DB::connection($this->connections['characters'])
            ->table('characters')
            ->where('name', $name)
            ->pluck('guid');

        Cache::put($key, $guid, $this->cacheDuration);

        return $guid;
    }

    /**
     * Get associative array (guid => name) of all players online
     * @return array
     */
    public function getPlayersOnline()
    {
        $key = $this->cacheKey(__FUNCTION__);

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        $list = DB::connection($this->connections['characters'])
            ->table('characters')
            ->where('online', 1)
            ->lists('name', 'guid');

        Cache::put($key, $list, $this->cacheDuration);

        return $list;
    }

    /**
     * Get character by GUID
     * @param int $guid
     * @return Character
     * @throws InvalidArgumentException
     */
    public function getCharacter($guid)
    {
        $key = $this->cacheKey(__FUNCTION__, $guid);

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        switch ($this->type)
        {
            case Realm::REALM_MANGOS:
                $attributes = ['guid', 'account', 'name', 'race', 'class', 'level', 'money'];
                break;

            case Realm::REALM_TRINITY:
                $attributes = ['guid', 'account', 'name', 'race', 'class', 'level', 'money'];
                break;

            default:
                throw new InvalidArgumentException; // ToDo: own exception
        }

        $char = Character::on($this->connections['characters'])
            ->find($guid, $attributes);

        Cache::put($key, $char, $this->cacheDuration);

        return $char;
    }
}
