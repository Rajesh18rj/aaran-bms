<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\AccountType;
use Illuminate\Database\Seeder;

class S119_AccountTypeSeeder extends Seeder
{
    public static function run(): void
    {
        AccountType::create([
            'vname' => 'Savings',
            'active_id' => '1'
        ]);

        AccountType::create([
            'vname' => 'Current',
            'active_id' => '1'
        ]);

    }
}
