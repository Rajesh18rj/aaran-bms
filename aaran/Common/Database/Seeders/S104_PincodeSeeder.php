<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Pincode;
use Illuminate\Database\Seeder;

class S104_PincodeSeeder extends Seeder
{
    public static function run(): void
    {
        Pincode::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        Pincode::create([
            'vname' => '641601',
            'active_id' => '1'
        ]);

        Pincode::create([
            'vname' => '641602',
            'active_id' => '1'
        ]);

        Pincode::create([
            'vname' => '641603',
            'active_id' => '1'
        ]);

        Pincode::create([
            'vname' => '641604',
            'active_id' => '1'
        ]);

        Pincode::create([
            'vname' => '641605',
            'active_id' => '1'
        ]);

        Pincode::create([
            'vname' => '641606',
            'active_id' => '1'
        ]);
    }
}
