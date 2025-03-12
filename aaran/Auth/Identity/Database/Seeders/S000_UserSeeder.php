<?php

namespace Aaran\Auth\Identity\Database\Seeders;

use Illuminate\Database\Seeder;

class S000_UserSeeder extends Seeder
{
    public static function run(): void
    {

        S03_UserSeeder::run();
        S02_RoleSeeder::run();

    }
}
