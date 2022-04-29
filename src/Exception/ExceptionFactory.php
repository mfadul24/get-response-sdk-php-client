<?php
namespace Getresponse\Sdk\Client\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ExceptionFactory
 * @package Getresponse\Sdk\Client\Exception
 */
class ExceptionFactory
{
    /**
     * @param $message
     * @return RequestException
     */
    public static function exceptionFrom(
        int $httpStatusCode,
        RequestInterface $request,
        string $message,
        array $handlerInfo,
        string $clientVersion,
        ResponseInterface $response = null
    ) {
        if ($httpStatusCode === ConnectException::CODE) {
            return new ConnectException($message, $request, $handlerInfo, $clientVersion, $response);
        }
        if ($httpStatusCode > 499) {
            return new ServerException($message, $request, $handlerInfo, $clientVersion, $response);
        }
        if ($httpStatusCode == 403) {
            return new ForbiddenException($message, $request, $handlerInfo, $clientVersion, $response);
        }
        if ($httpStatusCode == 401) {
            return new UnauthorizedException($message, $request, $handlerInfo, $clientVersion, $response);
        }
        if ($httpStatusCode == 400) {
            return new BadRequestException($message, $request, $handlerInfo, $clientVersion, $response);
        }
        if ($httpStatusCode > 400) {
            return new ClientException($message, $request, $handlerInfo, $clientVersion, $response);
        }

        return new RequestException($message, $request, $handlerInfo, $clientVersion, $response);
    }
}
