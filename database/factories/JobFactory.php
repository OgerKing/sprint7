<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'queue' => $this->faker->word(),
            'payload' => $this->faker->text(),
            'attempts' => $this->faker->randomNumber(),
            'available_at' => $this->faker->randomNumber(),
            'created_at' => $this->faker->randomNumber(),
        ];
    }
}
