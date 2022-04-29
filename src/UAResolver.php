<?php
namespace Getresponse\Sdk\Client;

use Getresponse\Sdk\Client\Handler\RequestHandler;
use Getresponse\Sdk\Client\Operation\OperationVersionable;

/**
 * Class UAResolver
 * @package Getresponse\Sdk\Client
 */
class UAResolver
{
    /**
     * @return string
     */
    public static function resolve(RequestHandler $handler, OperationVersionable $operation)
    {
        return sprintf(
            '%s GetResponse-Client/%s %s (%s)',
            $operation->getVersion(),
            Version::VERSION ,
            self::getHandlerName($handler),
            $handler->getUAString()
        );
    }
    
    /**
     * @return string
     */
    private static function getHandlerName(RequestHandler $handler)
    {
        $parts = explode('\\', $handler::class);
        return end($parts);
    }
}