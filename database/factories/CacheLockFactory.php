<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CacheLockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner' => $this->faker->word(),
            'expiration' => $this->faker->randomNumber(),
        ];
    }
}
