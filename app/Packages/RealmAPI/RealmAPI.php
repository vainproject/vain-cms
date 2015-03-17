<?php namespace Vain\Packages\RealmAPI;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 26.01.2015
 * Time: 20:36
 */

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;
use Vain\Packages\RealmAPI\Models\Character;

abstract class RealmAPI
{
    const REALM_TRINITY = 1;
    const REALM_MANGOS = 2;

    /**
     * @var $id Integer
     */
    protected $id;

    /**
     * @var $soap \SoapClient
     */
    protected $soap;

    /**
     * @var $useCache Boolean
     */
    protected $useCache;

    /**
     * @var $databases array
     */
    protected $connections;

    public function __construct($id, $useCache = true)
    {
        $this->useCache = $useCache;

        switch ($id) {
            case RealmAPI::REALM_TRINITY:
                $this->connections = [
                    'auth' => 'trinity_auth',
                    'world' => 'trinity_world',
                    'characters' => 'trinity_characters',
                    'dynamics' => 'trinity_dynamics',
                ];
                $this->id = $id;
                break;
            case RealmAPI::REALM_MANGOS:
                $this->connections = [
                    'auth' => 'mangos_auth',
                    'world' => 'mangos_world',
                    'characters' => 'mangos_characters',
                    'dynamics' => 'mangos_dynamics',
                ];
                $this->id = $id;
                break;
            default:
                throw new \InvalidArgumentException("Invalid realm id [$id]");
        }

        $config = Config::get('realms', $this->id);
        $this->soap = new \SoapClient(null,
            [
                "location" => "http://" . $config['host'] . ":" . $config['port'] . "/",
                "uri" => "urn:MaNGOS",
                "style" => SOAP_RPC,
                "login" => $config['username'],
                "password" => $config['password'],
                "connection_timeout" => 300,
            ]);
    }

    /**
     * Returns the realm id
     * @return mixed
     */
    public function getRealmType()
    {
        return $this->id;
    }

    /**
     * Will send a SOAP command to the realm
     * @param $command
     * @return String|null
     */
    public function send($command)
    {
        // ToDo: logging
        try {
            $result = $this->soap->executeCommand(new \SoapParam($command, "command"));
            return $result;
        } catch (\SoapFault $e) {
            return null;
        }
    }

    /**
     * Get character name by GUID
     * @param $guid Integer
     * @return String|null
     */
    public function getCharacterNameByGuid($guid)
    {
        $key = 'getCharacterNameByGuid-' . $this->id . '-' . $guid;
        if ($this->useCache && Cache::has($key)) return Cache::get($key);

        $name = DB::connection($this->connections['world'])->table('characters')->where('guid', $guid)->pluck('name');
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
        $key = 'getCharacterGuidByName-' . $this->id . '-' . $name;
        if ($this->useCache && Cache::has($key)) return Cache::get($key);

        $guid = DB::connection($this->connections['characters'])->table('characters')->where('name',
            $name)->pluck('guid');
        Cache::put($key, $name, 24 * 60);

        return $guid;
    }

    /**
     * Get associative array (guid => name) of all players online
     * @return array
     */
    public function getPlayersOnline()
    {
        $key = 'getCharacterGuidByName-' . $this->id;
        if ($this->useCache && Cache::has($key)) return Cache::get($key);

        $list = DB::connection($this->connections['characters'])->table('characters')->where('online', 1)->lists('name',
            'guid');
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
        $key = 'getCharacter-' . $this->id . '-' . $guid;
        if ($this->useCache && Cache::has($key)) return Cache::get($key);

        switch ($this->id) {
            case Realm::REALM_MANGOS:
                $attributes = ['guid', 'account', 'name', 'race', 'class', 'level', 'money'];
                break;
            case Realm::REALM_TRINITY:
                $attributes = ['guid', 'account', 'name', 'race', 'class', 'level', 'money'];
                break;
            default: throw new InvalidArgumentException; // ToDo: own exception
        }

        $char = Character::on($this->connections['characters'])->find($guid, $attributes);
        Cache::put($key, $char, 24 * 60);

        return $char;
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
}
