<?php

return [
    'roles' => [
        'admin' => [
            'name' => 'Administrator',
            'permissions' => ['manage-users', 'manage-roles', 'manage-permissions'],
        ],
        'moderator' => [
            'name' => 'Moderator',
            'permissions' => ['manage-users'],
        ],
        'user' => [
            'name' => 'User',
            'permissions' => [],
        ],
    ],

    'default_role' => 'user',

    'super_admin' => 'admin',
];
