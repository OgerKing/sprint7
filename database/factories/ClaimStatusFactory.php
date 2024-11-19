<?php

namespace Database\Factories;

use App\Models\ClaimStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClaimStatus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'claim_status_code' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'claim_status_description' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
