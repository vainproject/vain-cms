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
    protected $client;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var int
     */
    protected $timeout = self::DEFAULT_TIMEOUT;

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
     * dismiss soap connection
     */
    function __destruct()
    {
        $this->client = null;
    }

    /**
     * @param array $config
     * @return $this
     */
    public function configure( $config )
    {
        $this->config = [
            "location" => sprintf("http://%s:%s/", $config['host'], $config['port']),
            "uri" => "urn:MaNGOS",
            "style" => SOAP_RPC,
            "login" => $config['username'],
            "password" => $config['password'],
            "connection_timeout" => $this->timeout,
        ];

        return $this;
    }

    /**
     * opens connection to soap if not allready done
     *
     * @return SoapClient
     */
    public function client()
    {
        if ($this->client === null)
        {
            $this->client = new SoapClient(null, $this->config);
        }

        return $this->client;
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
            return $this->client()->executeCommand(new SoapParam($command, "command"));
        }
        catch (SoapFault $e)
        {
            return null;
        }
    }
}