<?php
namespace Getresponse\Sdk\Client\Operation;

/**
 * Class OperationResponseCollection
 * @package Getresponse\Sdk\Client\Operation
 */
class OperationResponseCollection implements \IteratorAggregate
{
    /**
     * OperationResponseCollection constructor.
     * @param array|OperationResponse[] $operations
     * @param array|SuccessfulOperationResponse[] $succeeded
     * @param array|FailedOperationResponse[] $failed
     */
    public function __construct(private readonly array $operations, private readonly array $succeeded, private readonly array $failed)
    {
    }
    
    /**
     * @return \ArrayIterator |  OperationResponse[]
     */
    public function getIterator(): \ArrayIterator|array
    {
        return new \ArrayIterator($this->operations);
    }
    
    /**
     * @return array | OperationResponse[]
     */
    public function getAll()
    {
        return $this->operations;
    }
    
    /**
     * @return bool
     */
    public function hasFailures()
    {
        return !empty($this->failed);
    }
    
    /**
     * @return array | SuccessfulOperationResponse[]
     */
    public function getSucceededOperations()
    {
        return $this->succeeded;
    }
    
    /**
     * @return array | FailedOperationResponse[]
     */
    public function getFailedOperations()
    {
        return $this->failed;
    }
    
}