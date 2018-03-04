<?php

namespace Axmit\FeatureToggle\Exception;

use Axmit\FeatureToggle\Condition\ConditionInterface;
use Exception;

/**
 * Class BadConditionException
 *
 * @package Axmit\FeatureToggle\Exception
 */
class BadConditionException extends Exception
{
    public static function forInstance($object)
    {
        $message = sprintf(
            'Instance of %s expected, got %s',
            ConditionInterface::class,
            is_object($object) ? get_class($object) : gettype($object)
        );

        return new static($message);
    }
}
