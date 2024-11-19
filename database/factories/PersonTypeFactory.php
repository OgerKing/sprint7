<?php

namespace Database\Factories;

use App\Models\PersonType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'person_type_name' => $this->faker->regexify('[A-Za-z0-9]{36}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
