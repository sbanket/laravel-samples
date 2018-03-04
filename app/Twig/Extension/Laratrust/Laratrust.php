<?php

namespace App\Twig\Extension\Laratrust;

use Laratrust as LaratrustFacade;
use Project\Employee\Dto\EmployeeEntityTo;
use Project\Employee\Permission\Assertion\EmployeeManager;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class Laratrust
 *
 * @package Twig\Extension\Laratrust
 */
class Laratrust extends Twig_Extension
{
    /**
     * @var EmployeeManager
     */
    protected $employeeManagerAssertion;

    /**
     * Laratrust constructor.
     *
     * @param EmployeeManager $employeeManagerAssertion
     */
    public function __construct(EmployeeManager $employeeManagerAssertion)
    {
        $this->employeeManagerAssertion = $employeeManagerAssertion;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_Extension_App_Laratrust';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('can', [$this, 'can']),
            new Twig_SimpleFunction('hasRole', [$this, 'hasRole']),
            new Twig_SimpleFunction('canAndOwns', [$this, 'canAndOwns']),
            new Twig_SimpleFunction('hasRoleAndOwns', [$this, 'hasRoleAndOwns']),
            new Twig_SimpleFunction('assertEmployeeManager', [$this, 'assertEmployeeManager']),
            new Twig_SimpleFunction('assertCurrentUser', [$this, 'assertCurrentUser']),
        ];
    }

    /**
     * @param string $permission
     * @param null   $team
     * @param bool   $requireAll
     *
     * @return bool
     */
    public function can($permission, $team = null, $requireAll = false)
    {
        return LaratrustFacade::can($permission, $team, $requireAll);
    }

    /**
     * @param string $role
     * @param null   $team
     * @param bool   $requireAll
     *
     * @return bool
     */
    public function hasRole($role, $team = null, $requireAll = false)
    {
        return LaratrustFacade::hasRole($role, $team, $requireAll);
    }

    /**
     * @param string $permission
     * @param object $thing
     * @param array  $options
     *
     * @return bool
     */
    public function canAndOwns($permission, $thing, $options = array())
    {
        return LaratrustFacade::canAndOwns($permission, $thing, $options);
    }

    /**
     * @param string $role
     * @param object $thing
     * @param array  $options
     *
     * @return bool
     */
    public function hasRoleAndOwns($role, $thing, $options = array())
    {
        return LaratrustFacade::hasRoleAndOwns($role, $thing, $options);
    }

    /**
     * @param EmployeeEntityTo $employee
     *
     * @return bool
     */
    public function assertEmployeeManager(EmployeeEntityTo $employee)
    {
        return $this->employeeManagerAssertion->assert($employee);
    }

    /**
     * @param EmployeeEntityTo $employee
     *
     * @return bool
     */
    public function assertCurrentUser(EmployeeEntityTo $employee)
    {
        return $employee->getUser()->getId() === \Auth::user()->id;
    }
}
