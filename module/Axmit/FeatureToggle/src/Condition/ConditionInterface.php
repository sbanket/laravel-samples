<?php

namespace Axmit\FeatureToggle\Condition;

/**
 * Interface ConditionInterface
 *
 * @package Axmit\FeatureToggle\Condition
 */
interface ConditionInterface
{
    /**
     * @param Context|null $context
     *
     * @return bool
     */
    public function isActive(Context $context = null);
}
