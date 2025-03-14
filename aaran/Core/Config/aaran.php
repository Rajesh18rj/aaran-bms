<?php


return [

    'version' => '1.0.0',

    'default_tenant' => 'main',

    'maintenance_mode' => false,

    'industries' => [
        'Garments',
        'OffsetPrinting',
    ],

    'migration_order' => [
        'createTenantsTable',
        'createSettingsTable',
        'createIndustrySettingsTable',
        // Add more migrations in the required order
    ],


];
