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
use App\Models\County;
use App\Models\Court;
use App\Models\Grant;
use App\Models\PodComment;
use App\Models\PodGlobalDocument;
use App\Models\PodWaterRight;
use App\Models\Program;
use App\Models\WaterRight;
use App\Models\WaterRightGlobalDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class PodWaterRightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PodWaterRight::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'acre_ft_pri' => $this->faker->randomFloat(0, 0, 9999999999.),
            'acres_pri' => $this->faker->randomFloat(0, 0, 9999999999.),
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
            'county_id' => County::factory(),
            'court_id' => Court::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'grant_id' => Grant::factory(),
            'percent_cfs' => $this->faker->randomFloat(0, 0, 9999999999.),
            'pod_comments_id' => PodComment::factory(),
            'pod_global_documents_id' => PodGlobalDocument::factory(),
            'priority_date_id' => $this->faker->randomNumber(),
            'program_id' => Program::factory(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'water_right_global_documents_id' => WaterRightGlobalDocument::factory(),
            'water_right_id' => WaterRight::factory(),
        ];
    }
}
