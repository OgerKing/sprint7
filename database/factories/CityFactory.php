<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'city_name' => $this->faker->city,
            'created_by' => $by = $this->faker->regexify('[A-Za-z0-9]{4,32}'),
            'state_id' => $this->faker->randomLetter().$this->faker->randomLetter(),
            'updated_by' => $by,
        ];
    }
}
