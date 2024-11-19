<?php

namespace Database\Factories;

use App\Models\FlatRater;
use App\Models\NoUse;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoUseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NoUse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'assigned_acres' => $this->faker->randomFloat(0, 0, 9999999999.),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'flat_rater_id' => FlatRater::factory(),
            'map_serial' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'pou_id' => $this->faker->randomNumber(),
            'pou_id_access' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
