<?php

namespace Database\Factories;

use App\Models\DefendantType;
use App\Models\Person;
use App\Models\PersonInterestType;
use App\Models\PersonLegalInterestType;
use App\Models\Subfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfilePersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subfile_id' => Subfile::factory(),
            'person_id' => Person::factory(),
            'authorized_agent_person_id' => Person::factory(),
            'person_open_date' => fake()->optional()->dateTime(),
            'person_close_date' => fake()->optional()->dateTime(),
            'person_status' => fake()->randomNumber(),
            'person_type' => fake()->randomNumber(),
            'category' => fake()->randomLetter(),
            'cert_mail' => fake()->optional()->randomNumber(),
            'cid_no' => fake()->optional()->word,
            'person_email' => fake()->optional()->randomNumber(),
            'person_telephone' => fake()->optional()->randomNumber(),
            'mailing_address_address1' => fake()->optional()->word,
            'mailing_address_address2' => fake()->optional()->word,
            'mailing_address_city' => fake()->optional()->word,
            'mailing_address_county' => null,
            'mailing_address_postal_code' => fake()->optional()->randomNumber(),
            'mailing_address_state' => null,
            'attorney_last_name' => fake()->optional()->word,
            'attorney_first_name' => fake()->optional()->word,
            'attorney_middle_initial' => fake()->randomLetter(),
            'attorney_title' => fake()->optional()->word,
            'attorney_firm' => fake()->optional()->word,
            'is_authorized_agent' => fake()->optional()->randomNumber(1),
            'is_permittee' => fake()->optional()->randomNumber(),
            'is_defendant' => fake()->optional()->randomNumber(),
            'defendant_type_id' => DefendantType::factory(),
            'owner_set' => fake()->word,
            'person_interest_type_id' => PersonInterestType::factory(),
            'person_legal_interest_type_id' => PersonLegalInterestType::factory(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
