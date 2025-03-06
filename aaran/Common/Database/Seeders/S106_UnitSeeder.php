<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Unit;
use Illuminate\Database\Seeder;

class S106_UnitSeeder extends Seeder
{
    public static function run(): void
    {
        Unit::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        Unit::create([
            'vname' => 'KGS',
            'active_id' => '1'
        ]);

        Unit::create([
            'vname' => 'GMS',
            'active_id' => '1'
        ]);

        Unit::create([
            'vname' => 'LTR',
            'active_id' => '1'
        ]);
    }
}
