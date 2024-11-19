<?php

namespace Database\Factories;

use App\Models\AdjudicationSection;
use App\Models\WaterSource;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdjudicationSectionFactory extends Factory
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
            'adjudication_section_name' => $this->faker->name(),
            'adjudication_section_status_id' => \App\Models\AdjudicationSectionStatus::factory(),
            'adjudication_section_type_id' => \App\Models\AdjudicationSectionType::factory(),
            'boundary_name' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            // 'boundary_type' => 1,
            'water_source_id' => WaterSource::factory(),
            'basin_section' => 'sdf',

            'prefix' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            // 'section_type' => $this->faker->regexify('[A-Za-z0-9]{24}'),//TODO: this doesnt exist in model
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
