<?php

use App\Auth\AccessRegistry;

return [
    /** Available for all users */
    'employee.home'                 => ['*'],

    /** Scope limited routes */
    'admin.employees.*'               => [AccessRegistry::P_MANAGE_USERS, AccessRegistry::P_FULL_LOOKUP],
    'company.settings.*'              => [AccessRegistry::P_MANAGE_SYSTEM_SETTINGS, AccessRegistry::P_FULL_LOOKUP],
    'admin.company.*'                 => [AccessRegistry::P_FULL_LOOKUP],
];
