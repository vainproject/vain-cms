<?php namespace Modules\User\Exceptions;

/**
 * MissingAuthConfigException
 */
class MissingAuthConfigException extends Exception
{

    function __construct()
    {
        $message = "Please Ensure a config file is present at app/config/auth.php";

        parent::__construct($message);
    }
}