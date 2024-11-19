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
use App\Models\PodNameHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PodNameHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PodNameHistory::class;

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
            'end_date' => $this->faker->dateTime(),
            'grant_id' => Grant::factory(),
            'pod_basin' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'pod_comments_id' => $this->faker->randomDigitNot(2),
            'pod_global_documents_id' => $this->faker->randomDigitNot(2),
            'pod_name_id' => $this->faker->randomNumber(),
            'pod_nbr' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'pod_suffix' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'program_id' => $this->faker->randomDigitNot(2),
            'proposed' => $this->faker->numberBetween(-8, 8),
            's_id_access' => $this->faker->randomNumber(),
            'surface_pod_id' => $this->faker->randomDigitNot(2),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
