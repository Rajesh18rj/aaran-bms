<?php

namespace Aaran\Temp\Database\Factories;

use Aaran\Master\Models\Temp;
use Illuminate\Database\Eloquent\Factories\Factory;

class TempFactory extends Factory
{
    protected $model = Temp::class;

    public function definition(): array
    {
        return [
            'vname' => $this->faker->name(),
            'active_id' => '1',
        ];
    }
}
