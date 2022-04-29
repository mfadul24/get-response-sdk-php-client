<?php

namespace Getresponse\Sdk\Client\Operation;

/**
 * Class DateRangeSearch
 * @package Getresponse\Sdk\Client\Operation
 */
class DateRangeSearch
{
    /**
     * DateRangeSearch constructor.
     * @param string | null $from
     * @param string | null $to
     */
    public function __construct(private $from = null, private $to = null)
    {
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'from' => $this->from,
            'to' => $this->to
        ], 'strlen');
    }
}
