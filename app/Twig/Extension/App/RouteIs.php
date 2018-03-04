<?php

namespace App\Twig\Extension\App;

use Illuminate\Support\Facades\Route;

/**
 * Class RouteIs
 *
 * @package App\Twig\Extension\App
 */
class RouteIs extends \Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'App_Extension_App_Route_Is';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('route_is', [$this, 'checkRoute']),
        ];
    }

    /**
     * @param string $route
     *
     * @return null|string
     */
    public function checkRoute(string $route)
    {
        return Route::is($route);
    }
}
