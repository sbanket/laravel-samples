<?php

namespace Axmit\FeatureToggle\Exception;

use Exception;

/**
 * Class FeatureNotFoundException
 *
 * @package Epos\FeatureToggle\Exception
 */
class FeatureNotFoundException extends Exception
{
    public static function forFeature($feature)
    {
        return new static(sprintf('Feature `%s` not found', $feature));
    }
}
