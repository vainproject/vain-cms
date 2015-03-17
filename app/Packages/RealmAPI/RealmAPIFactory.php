<?php namespace Vain\Packages\RealmAPI;

use InvalidArgumentException;
use Vain\Packages\RealmAPI\Realms\RealmAPIMangos as Mangos;
use Vain\Packages\RealmAPI\Realms\RealmAPITrinity as Trinity;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 26.01.2015
 * Time: 20:52
 */


class RealmAPIFactory
{
    use Configurator;

    /**
     * @param $realm
     * @param bool $useCache
     * @return RealmAPI
     */
    public function create($realm, $useCache = true)
    {
        $type = $this->getTypeConfig($realm);

        switch ($type)
        {
            case RealmAPI::REALM_TRINITY:
                return new Trinity($realm, $useCache);

            case RealmAPI::REALM_MANGOS:
                return new Mangos($realm, $useCache);

            default:
                throw new InvalidArgumentException('Unsupported realm type \''. $type .'\'');
        }
    }
}
