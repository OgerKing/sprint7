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
use App\Models\GroundPod;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroundPodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GroundPod::class;

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
            'county_id' => County::factory(),
            'court_id' => Court::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'diameter_in' => $this->faker->randomFloat(0, 0, 9999999999.),
            'dom_map_label' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'grant_id' => $this->faker->randomDigitNot(2),
            'ground_pod_source_text' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
            'irrigation_id' => $this->faker->randomDigitNot(2),
            'log_filed' => $this->faker->dateTime(),
            'outside_adjudication_section' => $this->faker->numberBetween(-8, 8),
            'pod_comments_id' => $this->faker->randomDigitNot(2),
            'pod_global_documents_id' => $this->faker->randomDigitNot(2),
            'pod_wuc' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'power_source' => $this->faker->regexify('[A-Za-z0-9]{11}'),
            'program_id' => $this->faker->randomDigitNot(2),
            'pump_code' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'source_ug' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
