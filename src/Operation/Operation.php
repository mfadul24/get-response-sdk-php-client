<?php

namespace Getresponse\Sdk\Client\Operation;

/**
 * Interface Operation
 * @package Getresponse\Sdk\Client\Operation
 */
interface Operation extends OperationVersionable
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const DELETE = 'DELETE';

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return int
     */
    public function getSuccessCode();
}
