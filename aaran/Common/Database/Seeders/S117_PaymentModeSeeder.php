<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\PaymentMode;
use Illuminate\Database\Seeder;

class S117_PaymentModeSeeder extends Seeder
{
    public static function run(): void
    {

        PaymentMode::create([
            'vname' => 'Paytm',
            'active_id' => '1'
        ]);

        PaymentMode::create([
            'vname' => 'Google Pay',
            'active_id' => '1'
        ]);

        PaymentMode::create([
            'vname' => 'C O D',
            'active_id' => '1'
        ]);

        PaymentMode::create([
            'vname' => 'Credit Card',
            'active_id' => '1'
        ]);

        PaymentMode::create([
            'vname' => 'Debit Card',
            'active_id' => '1'
        ]);

    }
}
