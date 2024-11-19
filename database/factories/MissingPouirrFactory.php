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
use App\Models\MissingPouirr;
use App\Models\PouComment;
use App\Models\PouStatus;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissingPouirrFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MissingPouirr::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'acres' => $this->faker->randomFloat(0, 0, 9999999999.),
            'adjudication_courts_id' => AdjudicationCourt::factory(),
            'adjudication_document_id' => AdjudicationDocument::factory(),
            'adjudication_document_type_id' => AdjudicationDocumentType::factory(),
            'adjudication_hydro_boundary_type_id' => AdjudicationHydroBoundaryType::factory(),
            'adjudication_id' => Adjudication::factory(),
            'adjudication_section_status_id' => 1,
            'adjudication_section_type_id' => 1, //uses adjudicationSectionType::factory()
            'adjudication_sections_id' => AdjudicationSection::factory(),
            'adjudication_status_id' => AdjudicationStatus::factory(),
            'area' => $this->faker->randomFloat(0, 0, 9999999999.),
            'basin_nbr_hl' => $this->faker->randomNumber(),
            'bureau_id' => Bureau::factory(),
            'city_id' => City::factory(),
            'comments' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'county_id' => County::factory(),
            'court_id' => Court::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'crop_code' => $this->faker->randomFloat(0, 0, 9999999999.),
            'crop_field' => $this->faker->randomFloat(0, 0, 9999999999.),
            'grant_id' => Grant::factory(),
            'ia_id' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'ia_no' => $this->faker->randomFloat(0, 0, 9999999999.),
            'irr_sys_type' => $this->faker->randomLetter(),
            'lo_code' => $this->faker->randomLetter(),
            'map_nr_acr' => $this->faker->regexify('[A-Za-z0-9]{7}'),
            'map_qtr' => $this->faker->randomLetter(),
            'mult' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'no_right' => $this->faker->randomNumber(),
            'o_photo_no' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'perimeter' => $this->faker->randomFloat(0, 0, 9999999999.),
            'pl_id' => $this->faker->randomNumber(),
            'pl_idaccess' => $this->faker->randomNumber(),
            'pla_qtr16th' => $this->faker->randomLetter(),
            'pla_qtr_4th' => $this->faker->randomLetter(),
            'pla_qtr_64th' => $this->faker->randomLetter(),
            'pla_rng' => $this->faker->randomLetter(),
            'pla_sec' => $this->faker->randomLetter(),
            'pla_tws' => $this->faker->randomLetter(),
            'pou_comments_id' => PouComment::factory(),
            'pou_hl_txt' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'pou_irrigation_id' => $this->faker->randomNumber(),
            'pou_map_txt' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'pou_status_id' => PouStatus::factory(),
            'pou_tract_txt' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'program_id' => Program::factory(),
            'subsec_txt' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'work_notes' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'x' => $this->faker->randomFloat(0, 0, 9999999999.),
            'y' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
