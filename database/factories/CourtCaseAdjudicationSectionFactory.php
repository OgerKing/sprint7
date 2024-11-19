<?php

namespace Database\Factories;

use App\Models\AdjudicationSection;
use App\Models\CourtCase;
use App\Models\CourtCaseAdjudicationSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtCaseAdjudicationSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourtCaseAdjudicationSection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'court_case_id' => CourtCase::inRandomOrder()->first()->id,
            'adjudication_section_id' => AdjudicationSection::inRandomOrder()->first()->id,
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
