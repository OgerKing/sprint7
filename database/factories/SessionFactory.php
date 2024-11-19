<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payload' => $this->faker->text(),
            'last_activity' => $this->faker->randomNumber(),
        ];
    }
}
