<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DefendantDocumentPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'defendant_document_id' => \App\Models\DefendantDocument::factory(),
            'person_id' => \App\Models\Person::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
