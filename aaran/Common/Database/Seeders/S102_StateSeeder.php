<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\State;
use Illuminate\Database\Seeder;

class S102_StateSeeder extends Seeder
{
    public static function run(): void
    {
        State::create([
            'vname' => '-',
            'state_code' => '-',
            'active_id' => '1'
        ]);

        State::create([
            'vname' => 'Tamilnadu',
            'state_code' => '33',
            'active_id' => '1'
        ]);

        State::create([
            'vname' => 'Andhra Pradesh',
            'state_code' => '25',
            'active_id' => '1'
        ]);

        State::create([
            'vname' => 'Arunachal Pradesh',
            'state_code' => '26',
            'active_id' => '1'
        ]);

        State::create([
            'vname' => 'Kerala',
            'state_code' => '27',
            'active_id' => '1'
        ]);

        State::create([
            'vname' => 'Karnataka',
            'state_code' => '28',
            'active_id' => '1'
        ]);
    }
}
