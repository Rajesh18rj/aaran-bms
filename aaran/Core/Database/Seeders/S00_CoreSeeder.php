<?php

namespace Aaran\Core\Database\Seeders;

use Aaran\Tenant\Database\Seeders\S01_TenantSeeder;
use Illuminate\Database\Seeder;

class S00_CoreSeeder extends Seeder
{
    public static function run(): void
    {
       S01_TenantSeeder::run();
       S04_DefaultCompanySeeder::run();
       S05_SoftVersionSeeder::run();
    }
}
