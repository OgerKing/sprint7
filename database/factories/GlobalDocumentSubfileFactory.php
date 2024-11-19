<?php

namespace Database\Factories;

use App\Models\GlobalDocument;
use App\Models\GlobalDocumentSubfile;
use App\Models\Subfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\GlobalDocumentSubfile>
 */
final class GlobalDocumentSubfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalDocumentSubfile::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'global_document_id' => GlobalDocument::inRandomOrder()->first()->id,
            'subfile_id' => Subfile::inRandomOrder()->first()->id,
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
