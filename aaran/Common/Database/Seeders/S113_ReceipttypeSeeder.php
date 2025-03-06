<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\ReceiptType;
use Illuminate\Database\Seeder;

class S113_ReceipttypeSeeder extends Seeder
{
    public static function run(): void
    {
        ReceiptType::create([
            'vname' => '-',
            'active_id' => '1'
        ]);


        ReceiptType::create([
            'vname' => 'Cash',
            'active_id' => '1'
        ]);

        ReceiptType::create([
            'vname' => 'Cheque',
            'active_id' => '1'
        ]);

        ReceiptType::create([
            'vname' => 'PhonePe',
            'active_id' => '1'
        ]);

        ReceiptType::create([
            'vname' => 'GPay',
            'active_id' => '1'
        ]);

        ReceiptType::create([
            'vname' => 'RTGS',
            'active_id' => '1'
        ]);

        ReceiptType::create([
            'vname' => 'NEFT',
            'active_id' => '1'
        ]);
    }
}
