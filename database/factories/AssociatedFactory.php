<?php

namespace Database\Factories;

use App\Models\Associated;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssociatedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Associated::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTime(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_at' => $this->faker->dateTime(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'water_right_status_description' => $this->faker->regexify('[A-Za-z0-9]{250}'),
        ];
    }
}
