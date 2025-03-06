<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\ContactType;
use Illuminate\Database\Seeder;

class S116_ContactTypeSeeder extends Seeder
{
    public static function run(): void
    {
        ContactType::create([
            'id' => 1,
            'vname' => '-',
            'active_id' => '1'
        ]);

        ContactType::create([
            'id' => 2,
            'vname' => 'Creditors',
            'active_id' => '1'
        ]);

        ContactType::create([
            'id' => 3,
            'vname' => 'Debtors',
            'active_id' => '1'
        ]);
    }
}

