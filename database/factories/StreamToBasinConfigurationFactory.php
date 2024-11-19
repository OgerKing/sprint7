<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StreamToBasinConfigurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stream_system_id' => \App\Models\StreamSystem::factory(),
            'water_basin_id' => \App\Models\WaterBasin::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
