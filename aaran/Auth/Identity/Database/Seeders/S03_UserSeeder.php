<?php

namespace Aaran\Auth\Identity\Database\Seeders;

use Aaran\Auth\Identity\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class S03_UserSeeder extends Seeder
{
    public static function run(): void
    {
        User::create([
            'name' => 'sundar',
            'email' => 'sundar@sundar.com',
            'password' => bcrypt('kalarani'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'active_id' => '1',
        ]);

        User::create([
            'name' => 'Developer',
            'email' => 'developer@aaran.org',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'active_id' => '1',
        ]);

        User::create([
            'name' => 'audit',
            'email' => 'audit@aaran.org',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'active_id' => '1',
        ]);

        User::create([
            'name' => 'demo',
            'email' => 'demo@demo.com',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'active_id' => '1',
        ]);
    }
}
