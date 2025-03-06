<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Bank;
use Illuminate\Database\Seeder;

class S112_BankSeeder extends Seeder
{
    public static function run(): void
    {
        Bank::create([
            'vname' => 'State Bank Of India',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'Indian Overseas Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'IDFC',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'HDFC Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'Karur Vysya Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'AXIS Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'ICICI Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'IDBI Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'Kotak Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'Canara Bank',
            'active_id' => '1'
        ]);

        Bank::create([
            'vname' => 'TMB',
            'active_id' => '1'
        ]);
    }
}
