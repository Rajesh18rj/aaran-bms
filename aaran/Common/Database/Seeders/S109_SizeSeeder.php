<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Size;
use Illuminate\Database\Seeder;
class S109_SizeSeeder extends Seeder
{
    public static function run(): void
    {

        Size::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 's',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'm',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'l',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'xl',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'All size',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'Mixed size',
            'active_id' => '1'
        ]);
    }
}
