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
use App\Models\City;
use App\Models\County;
use App\Models\Court;
use App\Models\Grant;
use App\Models\PouComment;
use App\Models\PouGlobalDocument;
use App\Models\PouNonIrrigation;
use App\Models\PouStatus;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class PouNonIrrigationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PouNonIrrigation::class;

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
            'city_id' => City::factory(),
            'county_id' => County::factory(),
            'court_id' => Court::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'grant_id' => Grant::factory(),
            'map_id_desc' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'pou_comments_id' => PouComment::factory(),
            'pou_global_documents_id' => PouGlobalDocument::factory(),
            'pou_status_id' => PouStatus::factory(),
            'program_id' => Program::factory(),
            'r_id_access' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'zone' => $this->faker->randomLetter(),
        ];
    }
}
