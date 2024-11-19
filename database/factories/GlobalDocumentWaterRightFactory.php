<?php

namespace Database\Factories;

use App\Models\GlobalDocumentWaterRight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\GlobalDocumentWaterRight>
 */
final class GlobalDocumentWaterRightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalDocumentWaterRight::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'global_document_id' => \App\Models\GlobalDocument::factory(),
            'water_right_id' => \App\Models\WaterRight::factory(),
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
