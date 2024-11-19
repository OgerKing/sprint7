<?php

namespace Database\Factories;

use App\Models\WaterSource;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaterSourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaterSource::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'water_source_description' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'water_source_sort' => $this->faker->randomNumber(),
            'water_source_code' => $this->faker->regexify('[A-Za-z0-9]{2}'), //TODO: this is in model
            // 'water_source_type' => $this->faker->randomLetter(),//TODO: doesnt exist in watersource model
        ];
    }
}
