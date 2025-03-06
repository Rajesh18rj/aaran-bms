<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\TransactionType;
use Illuminate\Database\Seeder;

class S118_TransactionTypeSeeder extends Seeder
{
    public static function run(): void
    {
        TransactionType::create([
            'vname' => 'Receipt',
            'active_id' => '1'
        ]);

        TransactionType::create([
            'vname' => 'Payment',
            'active_id' => '1'
        ]);

    }
}
