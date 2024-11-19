<?php

namespace Database\Factories;

use App\Models\FlatRater;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlatRaterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlatRater::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'assigned_acres' => $this->faker->randomFloat(0, 0, 9999999999.),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'map_serial' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'pl_id' => $this->faker->randomNumber(),
            'pl_id_access' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
