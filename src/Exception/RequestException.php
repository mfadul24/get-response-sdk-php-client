<?php
namespace Getresponse\Sdk\Client\Exception;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RequestException
 * @package Getresponse\Sdk\Client\Exception
 */
class RequestException extends BaseException
{
    public const ERROR_CODE = 1;
    public const ERROR_MSG = 'general error: see response body for details';

    /**
     * RequestException constructor.
     *
     * @param string $message
     * @param RequestInterface $request
     * @param array $handlerInfo
     * @param string $clientVersion
     * @param ResponseInterface | null $response
     */
    public function __construct(
        string $message,
        private readonly RequestInterface $request,
        private readonly array $handlerInfo,
        private readonly string $clientVersion,
        private readonly ?ResponseInterface $response = null
    ) {
        parent::__construct(
            $this->getBaseMessage($response) . $message . ', client version: ' . $clientVersion,
            self::ERROR_CODE
        );
    }

    /**
     * @param ResponseInterface | null $response
     * @return string
     */
    public function getBaseMessage(ResponseInterface $response = null)
    {
        $responseCode = $response !== null ? $response->getStatusCode() : 0;
        return 'Request error, response code: ' . $responseCode . ', ' . $this->getExceptionSpecificMessage() . '. ';
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Response | null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getHandlerInfo()
    {
        return $this->handlerInfo;
    }

    /**
     * @param resource $curlHandle
     * @return array
     */
    public static function getHandlerInfoFromCurlHandler($curlHandle)
    {
        $info = curl_getinfo($curlHandle);
        $error = curl_error($curlHandle);

        return [
            'info' => $info,
            'error' => $error
        ];
    }

    /**
     * @return string
     */
    protected function getExceptionSpecificMessage()
    {
        return self::ERROR_MSG;
    }

    /**
     * @return string
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        if ($this->response !== null) {
            return (string) $this->response->getBody();
        }
        return '';
    }
}
