<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HydrographicDocumentPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hydrographic_document_id' => \App\Models\HydrographicDocument::factory(),
            'person_id' => \App\Models\Person::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
