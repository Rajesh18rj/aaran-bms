<?php

namespace Aaran\Core\Database\Seeders;

use Illuminate\Database\Seeder;

class S00_CoreSeeder extends Seeder
{
    public static function run(): void
    {
       S01_TenantSeeder::run();
       S02_RoleSeeder::run();
       S03_UserSeeder::run();
       S04_DefaultCompanySeeder::run();
       S05_SoftVersionSeeder::run();
    }
}
