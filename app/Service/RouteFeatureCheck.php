<?php

namespace App\Service;

use Axmit\FeatureToggle\FeatureToggleAwareInterface;
use Axmit\FeatureToggle\FeatureToggleAwareTrait;
use Illuminate\Routing\Route;

class RouteFeatureCheck implements FeatureToggleAwareInterface
{
    use FeatureToggleAwareTrait;

    /**
     * @var array
     */
    protected $featureRoutes;

    /**
     * RouteFeatureCheck constructor.
     *
     * @param array $featureRoutes
     */
    public function __construct($featureRoutes)
    {
        $this->featureRoutes = $featureRoutes;
    }

    /**
     * @param Route $route
     *
     * @return bool
     */
    public function checkActiveFeatureRoute(Route $route)
    {
        foreach ($this->featureRoutes as $routeRule => $value) {
            if (fnmatch($routeRule, $route->getName(), FNM_CASEFOLD | FNM_NOESCAPE)) {
                $feature = $value;
                break;
            }
        }

        if (!isset($feature)) {
            return true;
        }

        return $this->isFeatureActive($feature);
    }
}
