<?php

namespace App\Service;

use Illuminate\Routing\Route;
use Project\Employee\Dto\EmployeeEntityTo;

/**
 * Class RoutePermissionCheck
 *
 * @package App\Service
 */
class RoutePermissionCheck
{

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * RoutePermissionCheck constructor.
     *
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param EmployeeEntityTo $employee
     * @param Route $route
     *
     * @return bool
     */
    public function isGranted(EmployeeEntityTo $employee, Route $route): bool
    {
        $allowedPermissions = null;

        foreach ($this->rules as $routeRule => $permissions) {
            if (fnmatch($routeRule, $route->getName(), FNM_CASEFOLD | FNM_NOESCAPE)) {
                $allowedPermissions = (array)$permissions;
                break;
            }
        }

        if (empty($allowedPermissions)) {
            return true;
        }

        if (in_array('*', $allowedPermissions)) {
            return true;
        }

        return $employee->getUser()->getOriginal()->hasPermission($allowedPermissions);
    }
}
