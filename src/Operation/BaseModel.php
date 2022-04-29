<?php
namespace Getresponse\Sdk\Client\Operation;

/**
 * Class BaseModel
 * @package Getresponse\Sdk\Client\Model
 */
class BaseModel implements \JsonSerializable
{
    final const FIELD_NOT_SET = 'field_not_set';

    /**
     * @return array
     */
    function jsonSerialize()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function filterUnsetFields(array $data)
    {
        foreach ($data as $key => $value) {
            if (BaseModel::FIELD_NOT_SET === $value) {
                unset($data[$key]);
            }
        }

        return $data;
    }

}