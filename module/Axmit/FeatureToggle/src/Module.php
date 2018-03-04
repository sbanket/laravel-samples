<?php

namespace Axmit\FeatureToggle;

use App\Module\AbstractModule;
use Axmit\FeatureToggle\Condition\ConditionManager;
use Illuminate\Contracts\Container\Container;

/**
 * Class Module
 *
 * @package Epos\FeatureToggle
 */
class Module extends AbstractModule
{

    const ALIAS = 'axmit.feature-toggle';

    /**
     * @return string
     */
    public function getAlias()
    {
        return static::ALIAS;
    }

    public function boot()
    {
        $this->app->singleton(
            ConditionManager::class, function () {
            return new ConditionManager();
        });

        $this->app->singleton(
            ToggleManager::class, function () {
            $toggleConfig = \Config::get('features');
            $features     = isset($toggleConfig['features']) ? $toggleConfig['features'] : [];
            $isSilent     = isset($toggleConfig['silent_mode']) ? $toggleConfig['silent_mode'] : true;

            return new ToggleManager(
                $this->app->get(ConditionManager::class),
                $features,
                $isSilent
            );
        });

        $this->app->resolving(
            FeatureToggleAwareInterface::class,
            function (FeatureToggleAwareInterface $instance, Container $app) {
                $instance->setToggleManager($app->get(ToggleManager::class));

                return $instance;
            }
        );
    }

}
