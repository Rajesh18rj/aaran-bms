<?php

namespace Aaran\Core\Database\Factories;

use Aaran\Core\Models\SoftVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoftVersionFactory extends Factory
{
    protected $model = SoftVersion::class;

    public function definition(): array
    {
        return [
            'vname' => $this->faker->name(),
            'active_id' => '1',
        ];
    }
}
