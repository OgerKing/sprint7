<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\PersonEmail;
use App\Models\PersonStatus;
use App\Models\PersonTelephone;
use App\Models\PersonType;
use App\Models\PersonTypeSubtype;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'person_type_id' => PersonType::factory(),
            'person_subtype_id' => PersonTypeSubtype::factory(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'last_name' => $this->faker->lastName(),
            'suffix' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'person_start_date' => $this->faker->dateTime(),
            'person_end_date' => $this->faker->dateTime(),
            'person_status_id' => PersonStatus::factory(),
            'is_deceased' => $this->faker->numberBetween(-8, 8),
            'verified' => $this->faker->numberBetween(-8, 8),
            'person_address_id' => PersonAddress::factory(),
            'person_email_id' => PersonEmail::factory(),
            'person_telephone_id' => PersonTelephone::factory(),
            'special_handling_instructions' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'department' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'division' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'entity_name' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'created_at' => $this->faker->dateTime(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_at' => $this->faker->dateTime(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
