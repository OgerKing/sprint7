<?php

namespace Database\Factories;

use App\Models\GlobalDocument;
use App\Models\GlobalDocumentPOU;
use App\Models\Pou;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\GlobalDocumentPOU>
 */
final class GlobalDocumentPOUFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalDocumentPOU::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'global_document_id' => GlobalDocument::factory(),
            'POU_id' => Pou::factory(),
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
