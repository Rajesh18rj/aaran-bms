<?php

namespace Aaran\Core\Database\Seeders;

use Aaran\Core\Models\Role;
use Illuminate\Database\Seeder;

class S02_RoleSeeder extends Seeder
{
    public static function run(): void
    {
        Role::create([
            'vname' => 'sundar',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'admin',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'md',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'editor',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'viewer',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'Master',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'Assistant Master',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'Student',
            'active_id' => '1'
        ]);
    }
}
