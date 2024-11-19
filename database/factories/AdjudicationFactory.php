<?php

namespace Database\Factories;

use App\Models\Adjudication;
use App\Models\Bureau;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Adjudication>
 */
final class AdjudicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adjudication::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        Bureau::factory()->count(4)->create();
        $adjudicationName = $this->faker->name();

        return [
            'adjudication_name' => $adjudicationName,
            'adjudication_nickname' => $adjudicationName.'-Nickname',
            'bureau_id' => $this->faker->numberBetween(1, 4), //Choosing from the first 5 bureau ids
            'adjudication_status_id' => \App\Models\AdjudicationStatus::factory(),
            'adjudication_district_id' => \App\Models\AdjudicationDistrict::factory(),
            'coordinate_system' => fake()->optional()->word,
            'adjudication_boundary_map_link' => fake()->optional()->word,
            'hydrographic_survey_description' => fake()->optional()->word,
            'prefix' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
