<?php

namespace Axmit\FeatureToggle\Exception;

use Exception;

/**
 * Class ConditionNotFoundException
 *
 * @package Epos\FeatureToggle\Exception
 */
class ConditionNotFoundException extends Exception
{
    public static function forCondition($condition, $feature, \Throwable $previous = null)
    {
        $message = sprintf('Condition `%s` not found for feature `%s`', $condition, $feature);

        return new static($message, 0, $previous);
    }
}
