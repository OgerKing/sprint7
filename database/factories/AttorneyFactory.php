<?php

namespace Database\Factories;

use App\Models\Attorney;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttorneyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attorney::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'activity' => $this->faker->randomLetter(),
            'address' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'address_2' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'at_sort' => $this->faker->randomFloat(0, 0, 999999999999999999.),
            'attorney_id_access' => $this->faker->randomNumber(),
            'city' => $this->faker->city(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'fax' => $this->faker->regexify('[A-Za-z0-9]{32}'),
            'firm' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'selected' => $this->faker->numberBetween(-8, 8),
            'state' => $this->faker->randomLetter(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'zip' => $this->faker->postcode(),
        ];
    }
}
