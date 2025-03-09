<?php

return [
    'default_role' => 'user',
    'registration' => true,
    'verification' => true,
    'password_min_length' => 6,
    'allow_password_reset' => true,
    'allow_social_login' => true,

    'avatar' => [
        'default' => 'storage/avatars/default.png',
        'storage_disk' => 'public',
        'allowed_mimes' => ['jpg', 'png', 'jpeg'],
        'max_size' => 2048,
    ],
];

