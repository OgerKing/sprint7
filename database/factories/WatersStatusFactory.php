<?php

namespace Database\Factories;

use App\Models\WatersStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class WatersStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WatersStatus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'waters_status_code' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'waters_status_description' => $this->faker->regexify('[A-Za-z0-9]{128}'),
        ];
    }
}
