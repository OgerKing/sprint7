<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pou_id' => $this->faker->randomDigitNotNull(),
            'map_serial' => $this->faker->word(),
            'assigned_acres' => $this->faker->randomNumber(),
            'pou_id_access' => $this->faker->randomNumber(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
