<?php

return [
    'table' => 'permission_role',

    'columns' => [
        'role_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'roles.id',
            'onDelete' => 'cascade',
        ],
        'permission_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'permissions.id',
            'onDelete' => 'cascade',
        ],
    ],
];
