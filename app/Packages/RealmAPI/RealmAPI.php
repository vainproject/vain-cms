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
abstract class RealmAPI
{
    use Configurator;

    const REALM_TRINITY = 1;

    const REALM_MANGOS = 2;

    /**
     * @var $realm string
     */
    protected $realm;

    /**
     * @var $useCache Boolean
     */
    protected $useCache;

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
            ->connect($this->getSoapConfig($realm));
    }


    /**
     * Get information about running realm (player online, uptime, ...)
     * @return array
     */
    public abstract function getServerStatus();

    /**
     * Send an item to a player
     * @param $guid Integer
     * @param $item Integer
     * @returns boolean
     */
    public abstract function sendItem($guid, $item);

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
     * @param $guid Integer
     * @return String|null
     */
    public function getCharacterNameByGuid($guid)
    {
        $key = 'getCharacterNameByGuid-' . $this->realm . '-' . $guid;

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        $name = DB::connection($this->connections['world'])
            ->table('characters')
            ->where('guid', $guid)
            ->pluck('name');

        Cache::put($key, $name, 24 * 60);

        return $name;
    }

    /**
     * Get GUID by character name
     * @param $name String
     * @return Integer|null
     */
    public function getCharacterGuidByName($name)
    {
        $key = 'getCharacterGuidByName-' . $this->realm . '-' . $name;

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        $guid = DB::connection($this->connections['characters'])
            ->table('characters')
            ->where('name', $name)
            ->pluck('guid');

        Cache::put($key, $guid, 24 * 60);

        return $guid;
    }

    /**
     * Get associative array (guid => name) of all players online
     * @return array
     */
    public function getPlayersOnline()
    {
        $key = 'getPlayersOnline-' . $this->realm;

        if ($this->useCache && Cache::has($key))
            return Cache::get($key);

        $list = DB::connection($this->connections['characters'])
            ->table('characters')
            ->where('online', 1)
            ->lists('name', 'guid');

        Cache::put($key, $list, 1);

        return $list;
    }

    /**
     * Get character by GUID
     * @param $guid Integer
     * @return Character
     * @throws InvalidArgumentException
     */
    public function getCharacter($guid)
    {
        $key = 'getCharacter-' . $this->realm . '-' . $guid;

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

        Cache::put($key, $char, 24 * 60);

        return $char;
    }
}
