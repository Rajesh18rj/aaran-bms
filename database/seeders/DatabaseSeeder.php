<?php

namespace Database\Seeders;

use Aaran\Auth\User\Database\Seeders\S000_UserSeeder;
use Aaran\Common\Database\Seeders\S000_CommonSeeder;
use Aaran\Core\Database\Seeders\S00_CoreSeeder;
use Aaran\Master\Database\Seeders\S199_MasterSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        S00_CoreSeeder::run();
        S000_UserSeeder::run();
        S000_CommonSeeder::run();
        S199_MasterSeeder::run();
    }
}
