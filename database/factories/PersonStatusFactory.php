<?php

namespace Database\Factories;

use App\Models\PersonStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonStatus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'person_status_description' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
