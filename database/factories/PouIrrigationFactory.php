<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PouIrrigationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pou_id' => \App\Models\Pou::factory(),
            'arcgis_processing_id' => \App\Models\ArcgisProcessing::factory(),
            'pou_status_id' => \App\Models\PouStatus::factory(),
            'bureau_id' => \App\Models\Bureau::factory(),
            'grant_id' => \App\Models\Grant::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
