<?php

namespace Database\Factories;

use App\Models\PouStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PouStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PouStatus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'display_line' => $this->faker->numberBetween(-8, 8),
            'display_summary' => $this->faker->numberBetween(-8, 8),
            'pou_status_code' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'pou_status_description' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
