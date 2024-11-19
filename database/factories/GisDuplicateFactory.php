<?php

namespace Database\Factories;

use App\Models\GisDuplicate;
use Illuminate\Database\Eloquent\Factories\Factory;

class GisDuplicateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GisDuplicate::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'basin' => $this->faker->regexify('[A-Za-z0-9]{27}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'dupeid' => $this->faker->randomNumber(),
            'number' => $this->faker->randomNumber(),
            'table_type' => $this->faker->regexify('[A-Za-z0-9]{27}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
