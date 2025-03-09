<?php

return [
    'table' => 'role_user',

    'columns' => [
        'user_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'users.id',
            'onDelete' => 'cascade',
        ],
        'role_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'roles.id',
            'onDelete' => 'cascade',
        ],
    ],
];

