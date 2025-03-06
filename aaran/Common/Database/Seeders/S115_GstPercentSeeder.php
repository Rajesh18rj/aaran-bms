<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\GstPercent;
use Illuminate\Database\Seeder;

class S115_GstPercentSeeder extends Seeder
{
    public static function run(): void
    {
        GstPercent::create([
            'vname' => '0',
            'desc' => '0 %',
            'active_id' => '1'
        ]);
    }
}

