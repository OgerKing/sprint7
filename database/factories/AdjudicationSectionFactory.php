<?php

namespace Database\Factories;

use App\Models\AdjudicationSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AdjudicationSection>
 */
final class AdjudicationSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjudicationSection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'adjudication_id' => \App\Models\Adjudication::factory(),
            'adjudication_section_name' => fake()->word,
            //prefix' => fake()->optional()->word,
            'prefix' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'adjudication_section_type_id' => \App\Models\AdjudicationSectionType::factory(),
            'adjudication_section_status_id' => \App\Models\AdjudicationSectionStatus::factory(),
            'water_source_id' => fake()->optional()->randomNumber(),
            'basin_section' => '',
            'extra_sub_file_tab' => fake()->optional()->randomNumber(1),
            'show_estate' => fake()->optional()->randomNumber(1),
            'program' => fake()->optional()->word,
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
