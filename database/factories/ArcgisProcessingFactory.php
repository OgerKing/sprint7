<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArcgisProcessingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adjudication_section_id' => \App\Models\AdjudicationSection::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
