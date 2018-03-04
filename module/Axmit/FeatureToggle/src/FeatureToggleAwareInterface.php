<?php

namespace Axmit\FeatureToggle;

/**
 * Interface FeatureToggleAwareInterface
 *
 * @package Axmit\FeatureToggle
 */
interface FeatureToggleAwareInterface
{
    /**
     * @param ToggleManager $manager
     *
     * @return void
     */
    public function setToggleManager(ToggleManager $manager);
}
