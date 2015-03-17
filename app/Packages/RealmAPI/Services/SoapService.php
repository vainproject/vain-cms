<?php namespace Vain\Packages\RealmAPI\Services;

use SoapClient;
use SoapFault;
use SoapParam;

class SoapService
{
    const DEFAULT_TIMEOUT = 300;

    /**
     * @var SoapClient
     */
    protected $soapClient;

    /**
     * @var int
     */
    protected $timeout = self::DEFAULT_TIMEOUT;

    /**
     * dismiss soap connection
     */
    function __destruct()
    {
        $this->soapClient = null;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout( $timeout )
    {
        $this->timeout = $timeout;
    }

    /**
     * @param $config
     * @return $this
     */
    public function connect($config)
    {
        $opts = [
            "location" => sprintf("http://%s:%s/", $config['host'], $config['port']),
            "uri" => "urn:MaNGOS",
            "style" => SOAP_RPC,
            "login" => $config['username'],
            "password" => $config['password'],
            "connection_timeout" => $this->timeout,
        ];

        $this->soapClient = new SoapClient(null, $opts);

        return $this;
    }

    /**
     * Will send a SOAP command to the realm
     * @param $command
     * @return String|null
     */
    public function send($command)
    {
        // ToDo: logging
        try
        {
            return $this->soapClient->executeCommand(new SoapParam($command, "command"));
        }
        catch (SoapFault $e)
        {
            return null;
        }
    }
}