<?php

namespace Database\Factories;

use App\Models\HsRecommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

class HsRecommendationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HsRecommendation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'amount_of_water' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'hs_recommend' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
