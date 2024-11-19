<?php

namespace Database\Factories;

use App\Models\HydrographicDocument;
use App\Models\Subfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class HydrographicDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HydrographicDocument::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_id' => Subfile::inRandomOrder()->first()->id,
            'hydrographic_document_title' => fake()->word,
            'hydrographic_document_filing_date' => fake()->optional()->dateTime(),
            'attachment_URL' => null,
            'attachment_file_path' => null,
            'document_type_id' => 393, //Hydrographic Survey in document_types
            'hydrographic_document_owner' => fake()->optional()->word,
            'hydrographic_document_owner_status' => fake()->optional()->word,
            'hydrographic_document_owner_type' => fake()->optional()->word,
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
