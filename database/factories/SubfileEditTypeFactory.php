<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileEditTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'edit_desc' => $this->faker->word(),
            'edit_type' => $this->faker->word(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
