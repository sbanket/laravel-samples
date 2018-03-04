<?php

namespace App\Auth;

/**
 * Class AccessRegistry
 *
 * @package App\Auth
 */
class AccessRegistry
{
    const R_EMPLOYEE = 'role.employee';
    const R_MANAGER  = 'role.manager';
    const R_ADMIN    = 'role.admin';

    const P_FULL_LOOKUP             = 'permission.full.lookup';
    const P_MANAGE_USERS            = 'permission.manage.users';
    const P_MANAGE_EMPLOYEES        = 'permission.manage.employees';
    const P_MANAGE_SYSTEM_SETTINGS  = 'permission.manager.system.settings';

}
