<?php

namespace Database\Factories;

use App\Models\WaterBasin;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaterBasinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaterBasin::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'quarter_report_configuration_id' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'water_basin_code' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'water_basin_description' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
