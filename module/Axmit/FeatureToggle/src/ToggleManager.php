<?php

namespace Axmit\FeatureToggle;

use Axmit\FeatureToggle\Condition\ConditionInterface;
use Axmit\FeatureToggle\Condition\Context;
use Axmit\FeatureToggle\Exception\BadConditionException;
use Axmit\FeatureToggle\Exception\ConditionNotFoundException;
use Axmit\FeatureToggle\Exception\FeatureNotFoundException;
use Illuminate\Contracts\Container\Container;

/**
 * Class ToggleManager
 *
 * @package Epos\FeatureToggle
 */
class ToggleManager
{
    /**
     * @var Container
     */
    protected $conditions;

    /**
     * @var array
     */
    protected $features = [];

    /**
     * @var bool
     */
    protected $silentMode = false;

    /**
     * ToggleManager constructor.
     *
     * @param Container $conditions
     * @param array     $features
     * @param bool      $silentMode
     */
    public function __construct(Container $conditions, array $features, $silentMode)
    {
        $this->conditions = $conditions;
        $this->features   = $features;
        $this->silentMode = $silentMode;
    }

    /**
     * @param string $feature
     * @param mixed  $context
     *
     * @return bool
     *
     * @throws ConditionNotFoundException
     * @throws FeatureNotFoundException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws BadConditionException
     */
    public function isActive($feature, $context = null)
    {
        $condition = isset($this->features[$feature]) ? $this->features[$feature] : null;

        if (!isset($condition) && false === $this->silentMode) {
            throw FeatureNotFoundException::forFeature($feature);
        }

        if (!$condition) {
            return false;
        }

        if (!$context instanceof Context) {
            $context = new Context($feature, $context);
        }

        return $this->extractCondition($condition, $context);
    }

    /**
     * @param         $condition
     * @param Context $context
     *
     * @return bool
     * @throws ConditionNotFoundException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws BadConditionException
     */
    protected function extractCondition($condition, Context $context)
    {
        if (is_bool($condition)) {
            return $condition;
        }

        if ($condition instanceof ConditionInterface) {
            return $condition->isActive($context);
        }

        try {
            /** @var ConditionInterface $condition */
            $this->features[$context->getFeature()] = $condition = $this->conditions->make($condition);
        } catch (BadConditionException $ex) {
            throw $ex;
        } catch (\Exception $ex) {
            throw ConditionNotFoundException::forCondition($condition, $context->getFeature(), $ex);
        }

        return $condition->isActive($context);
    }
}
