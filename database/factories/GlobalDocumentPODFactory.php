<?php

namespace Database\Factories;

use App\Models\GlobalDocumentPOD;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\GlobalDocumentPOD>
 */
final class GlobalDocumentPODFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalDocumentPOD::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'global_document_id' => \App\Models\GlobalDocument::factory(),
            'POD_id' => \App\Models\Pod::factory(),
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
