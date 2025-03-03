<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\TransactionType;
use Illuminate\Database\Seeder;

class S118_TransactionTypeSeeder extends Seeder
{
    public static function run(): void
    {
        TransactionType::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        TransactionType::create([
            'vname' => 'UPI',
            'active_id' => '1'
        ]);

        TransactionType::create([
            'vname' => 'Credit Card',
            'active_id' => '1'
        ]);

        TransactionType::create([
            'vname' => 'Debit Card',
            'active_id' => '1'
        ]);

    }
}
