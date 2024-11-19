<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuarterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quarter' => $this->faker->word(),
            'description' => $this->faker->word(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
