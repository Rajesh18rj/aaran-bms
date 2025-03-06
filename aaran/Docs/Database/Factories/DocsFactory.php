<?php

namespace Aaran\Docs\Database\Factories;

use Aaran\Docs\Models\Docs;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocsFactory extends Factory
{
    protected $model = Docs::class;
    public function definition(): array
    {
        return [
            'vname' => $this->faker->name(),
            'desc' => $this->faker->text(200),
            'company_id' => 1,
            'active_id' => '1',
        ];
    }
}
