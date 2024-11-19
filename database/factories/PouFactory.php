<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PouFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'arcgis_processing_id' => \App\Models\ArcgisProcessing::factory(),
            'pou_status_id' => \App\Models\PouStatus::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
