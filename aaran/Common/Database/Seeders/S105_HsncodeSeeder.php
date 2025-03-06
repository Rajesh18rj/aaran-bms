<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Hsncode;
use Illuminate\Database\Seeder;

class S105_HsncodeSeeder extends Seeder
{
    public static function run(): void
    {
        Hsncode::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        Hsncode::create([
            'vname' => '6100',
            'active_id' => '1'
        ]);

        Hsncode::create([
            'vname' => '1466',
            'active_id' => '1'
        ]);

        Hsncode::create([
            'vname' => '2922',
            'active_id' => '1'
        ]);
    }
}
