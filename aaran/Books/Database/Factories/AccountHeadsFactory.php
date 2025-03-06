<?php

namespace Aaran\Books\Database\Factories;

use Aaran\Books\Models\AccountHeads;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountHeadsFactory extends Factory
{
    protected $model = AccountHeads::class;

    public function definition(): array
    {
        return [
            'vname' => $this->faker->name,
            'description' => $this->faker->sentence(10),
            'opening' => '0',
            'opening_date' => '2025-01-01',
            'current' => '0',
            'active_id' => '1',
            'user_id' => '1',
        ];
    }
}
