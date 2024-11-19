<?php

namespace Database\Factories;

use App\Models\UseCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class UseCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UseCode::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'acres' => $this->faker->randomNumber(),
            'domestic' => $this->faker->randomNumber(),
            'old_only' => $this->faker->numberBetween(-8, 8),
            'use_description' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'use_type_nbr' => $this->faker->randomNumber(),
        ];
    }
}
