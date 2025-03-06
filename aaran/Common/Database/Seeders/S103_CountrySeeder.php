<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Country;
use Illuminate\Database\Seeder;

class S103_CountrySeeder extends Seeder
{
    public static function run(): void
    {
        Country::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        Country::create([
            'vname' => 'India',
            'active_id' => '1'
        ]);
    }
}
