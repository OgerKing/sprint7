<?php

namespace Database\Factories;

use App\Models\ClaimResolution;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimResolutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClaimResolution::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'claim_resolution_code' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'claim_resolution_description' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
