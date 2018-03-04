<?php

namespace Axmit\FeatureToggle\Condition;

/**
 * Class Context
 *
 * @package Axmit\FeatureToggle\Condition
 */
class Context
{

    /**
     * @var string
     */
    protected $feature;

    /**
     * @var mixed
     */
    protected $datum;

    /**
     * Context constructor.
     *
     * @param string $feature
     * @param mixed  $datum
     */
    public function __construct($feature, $datum = null)
    {
        $this->feature = $feature;
        $this->datum   = $datum;
    }

    /**
     * @return string
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     *
     * @return Context
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }
}
