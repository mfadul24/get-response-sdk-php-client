<?php

namespace Getresponse\Sdk\Client\Authentication;

use Psr\Http\Message\RequestInterface;

/**
 * Interface AuthenticationProvider
 * @package Getresponse\Sdk\Client\Authentication
 */
interface AuthenticationProvider
{
    /**
     * @return RequestInterface
     */
    public function authenticate(RequestInterface $request);
}
