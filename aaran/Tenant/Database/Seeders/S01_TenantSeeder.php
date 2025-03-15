<?php

namespace Aaran\Tenant\Database\Seeders;

use Aaran\Tenant\Models\Tenant;
use Illuminate\Database\Seeder;

class S01_TenantSeeder extends Seeder
{
    public static function run(): void
    {
        Tenant::create([
            't_name' => 'codexsun',
            'active_id' => '1'
        ]);
    }
}
