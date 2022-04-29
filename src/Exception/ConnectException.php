<?php
namespace Getresponse\Sdk\Client\Exception;

/**
 * Exception thrown on connection error, no response from server
 *
 * Class ConnectException
 * @package Getresponse\Sdk\Client\Exception
 */
class ConnectException extends RequestException
{
    final const CODE = 0;
    final const CONNECTION_ERROR_MSG = 'connection error: please check Your connectivity';

    /**
     * @return string
     */
    protected function getExceptionSpecificMessage()
    {
        return self::CONNECTION_ERROR_MSG;
    }
}
