<?php

namespace Database\Factories;

use App\Models\County;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = County::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // TODO: 'state_id' => State::factory(),
            'county' => $this->faker->randomLetter(),
            'county_name' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
