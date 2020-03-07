<?php

namespace App\Serializer;

/**
 * Handles all Circular Reference Exceptions by replacing entities with their IDs
 */
class CircularReferenceHandler
{
    public function __invoke($object)
    {
        return $object->getId();
    }
}