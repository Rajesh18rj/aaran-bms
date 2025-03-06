<?php

namespace Aaran\Core\Database\Seeders;

use Aaran\Core\Models\DefaultCompany;
use Illuminate\Database\Seeder;

class S04_DefaultCompanySeeder extends Seeder
{
    public static function run(): void
    {
        DefaultCompany::create([
            'company_id' => '1',
            'acyear' => '116',
        ]);
    }
}
