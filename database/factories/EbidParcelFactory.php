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
use App\Models\EbidParcel;
use App\Models\FileLocation;
use App\Models\GlobalDocument;
use App\Models\GlobalDocumentType;
use App\Models\Grant;
use App\Models\HydrographicDocument;
use App\Models\HydrographicDocumentType;
use App\Models\PouComment;
use App\Models\PouGlobalDocument;
use App\Models\PouStatus;
use App\Models\Program;
use App\Models\WaterRight;
use App\Models\WaterRightGlobalDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class EbidParcelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EbidParcel::class;

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
            'ebid_id' => $this->faker->randomNumber(),
            'file_location_id' => FileLocation::factory(),
            'global_document_id' => GlobalDocument::factory(),
            'global_document_type_id' => GlobalDocumentType::factory(),
            'grant_id' => Grant::factory(),
            'hydrographic_document_type_id' => HydrographicDocumentType::factory(),
            'hydrographic_documents_id' => HydrographicDocument::factory(),
            'parcel_acres' => $this->faker->randomFloat(0, 0, 9999999999.),
            'parcel_num' => $this->faker->numberBetween(-100000, 100000),
            'pou_comments_id' => PouComment::factory(),
            'pou_global_documents_id' => PouGlobalDocument::factory(),
            'pou_non_irr_id' => $this->faker->randomNumber(),
            'pou_status_id' => PouStatus::factory(),
            'program_id' => Program::factory(),
            'subfile_adjudication_status_id' => $this->faker->randomNumber(),
            'subfile_case_status_id' => $this->faker->randomNumber(),
            'subfile_id' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'water_right_global_documents_id' => WaterRightGlobalDocument::factory(),
            'water_right_id' => WaterRight::factory(),
        ];
    }
}
