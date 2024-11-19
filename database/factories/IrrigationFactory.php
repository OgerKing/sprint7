<?php

namespace Database\Factories;

use App\Models\Irrigation;
use Illuminate\Database\Eloquent\Factories\Factory;

class IrrigationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Irrigation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'pod_is' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'pod_is_description' => $this->faker->regexify('[A-Za-z0-9]{32}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
