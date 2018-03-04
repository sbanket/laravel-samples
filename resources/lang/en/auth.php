<?php

use App\Auth\AccessRegistry;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'success'  => 'Authentication successful',
    'failed'   => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    /** Following is the Authorization Rbac messages */
    'rbac'     => [
        /** Roles */
        AccessRegistry::R_ADMIN                  => 'Administrator',
        AccessRegistry::R_MANAGER                => 'Manager',
        AccessRegistry::R_EMPLOYEE               => 'Employee',

        /** Permissions */
        AccessRegistry::P_MANAGE_USERS           => 'Manage Users',
        AccessRegistry::P_MANAGE_EMPLOYEES       => 'Manage Employees',
        AccessRegistry::P_MANAGE_SYSTEM_SETTINGS => 'Manage system settings',
    ],
];
