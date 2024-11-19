<?php

namespace Database\Factories;

use App\Models\AdjudicationDocumentProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AdjudicationDocumentProgram>
 */
final class AdjudicationDocumentProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjudicationDocumentProgram::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'court_case_id' => \App\Models\CourtCase::factory(),
            'adjudication_document_id' => \App\Models\AdjudicationDocument::factory(),
            'document_type_id' => \App\Models\DocumentType::factory(),
            'adjudication_id' => \App\Models\Adjudication::factory(),
            'adjudication_section_status_id' => \App\Models\AdjudicationSectionStatus::factory(),
            'adjudication_section_type_id' => \App\Models\AdjudicationSectionType::factory(),
            'adjudication_sections_id' => \App\Models\AdjudicationSection::factory(),
            'adjudication_status_id' => \App\Models\AdjudicationStatus::factory(),
            'bureau_id' => \App\Models\Bureau::factory(),
            'court_id' => \App\Models\Court::factory(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
