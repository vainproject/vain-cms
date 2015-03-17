<?php namespace Vain\Packages\RealmAPI;

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

    /**
     * @param $id
     * @param bool $useCache
     * @return RealmAPI
     */
    public function create($id, $useCache = true)
    {
        switch ($id) {
            case RealmAPI::REALM_TRINITY:
                return new Trinity($useCache);
            case RealmAPI::REALM_MANGOS:
                return new Mangos($useCache);
            default:
                throw new \InvalidArgumentException("Unsupported realm [$id]");
        }
    }
}
