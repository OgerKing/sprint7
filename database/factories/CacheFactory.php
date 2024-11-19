<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->text(),
            'expiration' => $this->faker->randomNumber(),
        ];
    }
}
