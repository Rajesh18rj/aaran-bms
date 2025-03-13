<?php

namespace Aaran\Auth\Identity\Database\Factories;

use Aaran\Auth\Identity\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected $model = User::class;
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
//             'password' => static::$password ??= Hash::make('password'),
            'profile_photo' => null,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'tenant_id' => null,
            'active_id' => 1,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}
