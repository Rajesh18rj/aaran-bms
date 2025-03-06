<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\City;
use Illuminate\Database\Seeder;

class S101_CitySeeder extends Seeder
{
    public static function run(): void
    {
        City::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Tiruppur',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Coimbatore',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Erode',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Chennai',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Madurai',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Salem',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Tiruchirappalli',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Ambattur',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Tirunelveli',
            'active_id' => '1'
        ]);

        City::create([
            'vname' => 'Avadi',
            'active_id' => '1'
        ]);
    }
}
