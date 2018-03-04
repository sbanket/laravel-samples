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
    'success'  => 'Добро пожаловать',
    'failed'   => 'Логин и пароль не совпадают.',
    'throttle' => 'Слишком много попыток авторизации. Попробуйте снова через :seconds секунд.',

    /** Following is the Authorization Rbac messages */
    'rbac'     => [
        /** Roles */
        AccessRegistry::R_ADMIN                  => 'Администратор',
        AccessRegistry::R_MANAGER                => 'Менеджер',
        AccessRegistry::R_EMPLOYEE               => 'Сотрудник',

        /** Permissions */
        AccessRegistry::P_MANAGE_USERS           => 'Управлять пользователями',
        AccessRegistry::P_MANAGE_EMPLOYEES       => 'Управлять сотрудниками',
        AccessRegistry::P_MANAGE_SYSTEM_SETTINGS => 'Управлять настройками системы',
    ],
];
