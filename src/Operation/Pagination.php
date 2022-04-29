<?php

namespace Getresponse\Sdk\Client\Operation;

/**
 * Class Pagination
 * @package Getresponse\Sdk\Client\Operation
 */
class Pagination
{
    /**
     * Pagination constructor.
     * @param int $page
     * @param int $perPage
     */
    public function __construct(private $page, private $perPage)
    {
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
}
