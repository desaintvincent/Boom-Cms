<?php


namespace Boom\Model\Entities;


class Entity
{
    public function __get($property)
    {
        $propertyName = $this->prefix . $property;
        if (isset($this->{$propertyName})) {
            return $this->{$propertyName};
        }

        return false;
    }

}