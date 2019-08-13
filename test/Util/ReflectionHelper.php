<?php

namespace Paisa\Stripe\Test\Util;

use ReflectionClass;
use ReflectionProperty;

class ReflectionHelper
{
    public static function setField($obj, $fieldName, $value)
    {
        $reflectionProperty = self::getField($obj, $fieldName);
        $reflectionProperty->setValue($obj, $value);
    }

    public static function getField($obj, $fieldName)
    {
        $properties = self::getClassProperties($obj);
        /** @var ReflectionProperty $reflectionProperty */
        $reflectionProperty = $properties[$fieldName];
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty;
    }

    public static function getFieldValue($obj, $fieldName)
    {
        $field = self::getField($obj, $fieldName);
        return $field->getValue($obj);
    }

    public static function getMethod($obj, $methodName)
    {
        $reflectionClass = self::getClass($obj);
        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod;
    }

    public static function getClass($obj)
    {
        $reflectionClass = new ReflectionClass($obj);
        return $reflectionClass;
    }

    private static function getClassProperties($className)
    {
        $reflectionClass = self::getClass($className);
        $properties = $reflectionClass->getProperties();
        $allProperties = [];
        foreach ($properties as $property) {
            $fieldName = $property->getName();
            $allProperties[$fieldName] = $property;
        }
        if ($parentClass = $reflectionClass->getParentClass()) {
            $parentProperties = self::getClassProperties($parentClass->getName());
            if (count($parentProperties) > 0) {
                $allProperties = array_merge($parentProperties, $allProperties);
            }
        }
        return $allProperties;
    }
}