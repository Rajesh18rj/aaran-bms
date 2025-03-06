<?php

namespace Aaran\Core\Database\Seeders;

use Aaran\Core\Models\SoftVersion;
use Illuminate\Database\Seeder;

class S05_SoftVersionSeeder extends Seeder
{
    public static function run(): void
    {
        SoftVersion::create([
            'soft_version' => '1.0.0',
            'db_version' => '1.0.0',
            'title' => '-',
            'body' => '-',
        ]);
    }
}
