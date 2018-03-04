<?php

namespace Axmit\FeatureToggle;

/**
 * Trait FeatureToggleAwareTrait
 *
 * @package Axmit\FeatureToggle
 */
trait FeatureToggleAwareTrait
{
    /**
     * @var ToggleManager
     */
    protected $featureManager;

    /**
     * @param ToggleManager $manager
     *
     * @return void
     */
    public function setToggleManager(ToggleManager $manager)
    {
        $this->featureManager = $manager;
    }

    /**
     * @param string $feature
     * @param mixed  $context
     *
     * @return bool
     *
     * @throws Exception\ConditionNotFoundException
     * @throws Exception\FeatureNotFoundException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function isFeatureActive($feature, $context = null)
    {
        return $this->featureManager->isActive($feature, $context);
    }
}
