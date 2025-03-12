<?php

namespace Aaran\Auth\Identity\Database\Seeders;

use Aaran\Auth\Identity\Models\Role;
use Illuminate\Database\Seeder;

class S02_RoleSeeder extends Seeder
{
    public static function run(): void
    {
        Role::create([
            'vname' => 'sundar',
            'slug' => 'sundar',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'admin',
            'slug' => 'admin',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'md',
            'slug' => 'md',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'editor',
            'slug' => 'editor',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'viewer',
            'slug' => 'viewer',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'Master',
            'slug' => 'Master',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'Assistant Master',
            'slug' => 'Assistant Master',
            'active_id' => '1'
        ]);

        Role::create([
            'vname' => 'Student',
            'slug' => 'Student',
            'active_id' => '1'
        ]);
    }
}
