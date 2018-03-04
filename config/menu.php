<?php
return [
    'top-menu' => [
        'items' => [
            'manager_menu'  => [
                'label' => 'Management',
                'items' => [
                    'employees' => [
                        'label' => 'Employees',
                        'route' => 'manager.employees.list',
                    ],
                ],
            ],
            'settings_menu' => [
                'label' => 'Settings',
                'items' => [
                    'company'  => [
                        'label' => 'Company',
                        'route' => 'company.settings.main',
                    ],
                ],
            ],
        ],
    ],
];
