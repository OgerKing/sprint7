<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileOwnerHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_email_id' => \App\Models\ContactEmail::factory(),
            'contact_telephone_id' => \App\Models\ContactTelephone::factory(),
            'created_by' => $this->faker->word(),
            'defendant_type_id' => \App\Models\DefendantType::factory(),
            'address_id' => \App\Models\Address::factory(),
            'person_id' => \App\Models\Person::factory(),
            'person_interest_type_id' => \App\Models\PersonInterestType::factory(),
            'prev_oid' => $this->faker->randomNumber(),
            'subfile_persons_id' => \App\Models\SubfilePerson::factory(),
            'trans_date' => $this->faker->dateTime(),
            'transaction_id' => $this->faker->randomDigitNotNull(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
