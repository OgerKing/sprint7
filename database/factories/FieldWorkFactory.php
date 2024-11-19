<?php

namespace Database\Factories;

use App\Models\FieldWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class FieldWorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FieldWork::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'field_work_code' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'field_work_description' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
