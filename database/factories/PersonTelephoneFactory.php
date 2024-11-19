<?php

namespace Database\Factories;

use App\Models\PersonTelephone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonTelephoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonTelephone::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'primary_person_telephone_anumber' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            'primary_person_telephone_number_verified' => $this->faker->numberBetween(-8, 8),
            'secondary_person_telephone_number' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            'secondary_person_telephone_number_verified' => $this->faker->numberBetween(-100000, 100000),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
