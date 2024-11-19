<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\PersonAlias;
use App\Models\PersonAliasType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonAliasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonAlias::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'person_alias_type_id' => PersonAliasType::factory(),
            'entity_name' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
