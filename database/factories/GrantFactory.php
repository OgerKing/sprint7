<?php

namespace Database\Factories;

use App\Models\Grant;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'grant_code' => $this->faker->regexify('[A-Za-z0-9]{2}'),
            'grant_name' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'proj' => $this->faker->numberBetween(-8, 8),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
