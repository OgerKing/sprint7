<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StreamSystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stream_system_name' => $this->faker->word(),
            'is_in_wrats' => $this->faker->randomNumber(1),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
