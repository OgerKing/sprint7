<?php

namespace Database\Factories;

use App\Models\Adjudication;
use App\Models\AdjudicationCourt;
use App\Models\AdjudicationDocument;
use App\Models\AdjudicationDocumentType;
use App\Models\AdjudicationHydroBoundaryType;
use App\Models\AdjudicationSection;
use App\Models\AdjudicationSectionType;
use App\Models\AdjudicationStatus;
use App\Models\Bureau;
use App\Models\Court;
use App\Models\ImportError;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImportErrorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImportError::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'adjudication_courts_id' => AdjudicationCourt::factory(),
            'adjudication_document_id' => AdjudicationDocument::factory(),
            'adjudication_document_type_id' => AdjudicationDocumentType::factory(),
            'adjudication_hydro_boundary_type_id' => AdjudicationHydroBoundaryType::factory(),
            'adjudication_id' => Adjudication::factory(),
            'adjudication_section_status_id' => 1,
            'adjudication_section_type_id' => 1, //uses adjudicationSectionType::factory()
            'adjudication_sections_id' => AdjudicationSection::factory(),
            'adjudication_status_id' => AdjudicationStatus::factory(),
            'bureau_id' => Bureau::factory(),
            'court_id' => Court::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'error_datetime' => $this->faker->dateTime(),
            'error_description' => $this->faker->regexify('[A-Za-z0-9]{500}'),
            'program_id' => Program::factory(),
            'table_name' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'user_name' => $this->faker->userName(),
        ];
    }
}
