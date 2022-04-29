<?php

namespace Getresponse\Sdk\Client\Test\Unit\Operation;

use Getresponse\Sdk\Client\Exception\InvalidCommandDataException;
use Getresponse\Sdk\Client\Operation\CommandOperation;
use Getresponse\Sdk\Client\Operation\Operation;

/**
 * Class CommandOperationImplementation
 * @package Getresponse\Sdk\Client\Test\Unit\Operation
 */
class CommandOperationImplementation extends CommandOperation
{
    private ?\Getresponse\Sdk\Client\Test\Unit\Operation\UrlQueryParametersImplementation $urlParameterQuery = null;
    
    private ?\Getresponse\Sdk\Client\Test\Unit\Operation\AdditionalFlagsImplementation $additionalFlags = null;
    
    /**
     * @return array
     */
    protected function getAllowedFields()
    {
        return ['name', 'email', 'campaign'];
    }

    /**
     * @return array
     */
    protected function getRequiredFields()
    {
        return ['email', 'campaign'];
    }
    
    /**
     * @return $this
     */
    public function setUrlParameterQuery(UrlQueryParametersImplementation $urlParameterQuery)
    {
        $this->urlParameterQuery = $urlParameterQuery;
        return $this;
    }
    
    /**
     * @return $this
     */
    public function setAdditionalFlags(AdditionalFlagsImplementation $additionalFlags)
    {
        $this->additionalFlags = $additionalFlags;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getUrl()
    {
        $extra = $this->getAdditionalFlagsParameterArray($this->additionalFlags);
        return '/some-url' . $this->buildUrlQuery($this->urlParameterQuery, $extra);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return Operation::POST;
    }

    /**
     * @return string
     * @throws InvalidCommandDataException
     */
    public function getBody()
    {
        return $this->encode($this->data);
    }

    /**
     * @return int
     */
    public function getSuccessCode()
    {
        return 201;
    }
    
    /**
     * @return string
     */
    public function getVersion()
    {
        return 'Operation-1.0';
    }
}
