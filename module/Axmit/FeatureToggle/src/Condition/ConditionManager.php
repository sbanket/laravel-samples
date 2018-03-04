<?php

namespace Axmit\FeatureToggle\Condition;

use Axmit\FeatureToggle\Exception\BadConditionException;
use Illuminate\Container\Container;

/**
 * Class ConditionManager
 *
 * @package Axmit\FeatureToggle\Condition
 */
class ConditionManager extends Container
{
    public function __construct()
    {
        $this->afterResolving(
            function ($object, Container $container) {
                if (!$object instanceof ConditionInterface) {
                    throw BadConditionException::forInstance($object);
                }
            }
        );
    }

}
