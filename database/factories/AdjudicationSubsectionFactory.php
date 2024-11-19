<?php

namespace Database\Factories;

use App\Models\AdjudicationHydroBoundaryType;
use App\Models\AdjudicationSection;
use App\Models\AdjudicationSectionStatus;
use App\Models\AdjudicationSectionType;
use App\Models\AdjudicationSubsection;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdjudicationSubsectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjudicationSubsection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'parent_adjudication_subsection_id' => AdjudicationSection::factory(),
            'child_adjudication_subsection_id' => AdjudicationSection::factory(),
            //'subsection_name' => $this->faker->name(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            // 'adjudication_hydro_boundary_type_id' => AdjudicationHydroBoundaryType::factory(),
            // 'adjudication_section_name' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            // 'adjudication_section_status_id' => AdjudicationSectionStatus::factory(),
            // 'adjudication_section_type_id' => 1, //uses adjudicationSectionType::factory()
            // 'adjudication_sections_id' => AdjudicationSection::factory(),
            // 'adjudication_subsection_name' => $this->faker->randomLetter(),
            // 'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            // 'hydro_boundary_type' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            // 'prefix' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            // 'section_type' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            // 'subsection_status' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            // 'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
