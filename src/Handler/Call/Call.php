<?php

namespace Getresponse\Sdk\Client\Handler\Call;

use Getresponse\Sdk\Client\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Call
 * @package Getresponse\Sdk\Client\Handler\Call
 */
class Call
{
    private readonly string $id;
    
    private ?\Psr\Http\Message\ResponseInterface $response = null;
    
    private ?\Getresponse\Sdk\Client\Exception\RequestException $exception = null;
    
    /**
     * Call constructor.
     * @param RequestInterface $request
     * @param int $successCode
     * @param string | null $id
     */
    public function __construct(private readonly RequestInterface $request, private $successCode, $id = null)
    {
        $this->id = $id ?? uniqid();
    }
    
    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->id;
    }
    
    /**
     * @return int
     */
    public function getSuccessCode()
    {
        return $this->successCode;
    }
    
    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    public function setResponse(ResponseInterface $response)
    {
        if ($this->hasException()) {
            throw new \RuntimeException('Invalid state. Call has an exception within.');
        }
        if (null !== $this->response) {
            throw new \RuntimeException('Response cannot be overwritten.');
        }
        $this->response = $response;
    }
    
    /**
     * @return null|ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    public function setException(RequestException $exception)
    {
        if (null !== $this->response) {
            throw new \RuntimeException('Invalid state. Call has a response within.');
        }
        if (null !== $this->exception) {
            throw new \RuntimeException('Exception cannot be overwritten.');
        }
        $this->exception = $exception;
    }
    
    /**
     * @return RequestException
     */
    public function getException()
    {
        return $this->exception;
    }
    
    /**
     * @return bool
     */
    public function hasException()
    {
        return null !== $this->exception;
    }
    
    /**
     * @return bool
     */
    public function isSucceeded()
    {
        return null !== $this->getResponse() && $this->successCode === $this->getResponse()->getStatusCode();
    }
    
    /**
     * @return bool
     */
    public function isFinished()
    {
        return true === $this->hasException() || null !== $this->getResponse();
    }
}