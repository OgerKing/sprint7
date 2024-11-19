<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GlobalDocumentPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'global_document_id' => \App\Models\GlobalDocument::factory(),
            'person_id' => \App\Models\Person::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
