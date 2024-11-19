<?php

namespace Database\Factories;

use App\Models\CourtCase;
use App\Models\SubfileCourtCase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\SubfileCourtCase>
 */
final class SubfileCourtCaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubfileCourtCase::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_id' => \App\Models\Subfile::factory(),
            'court_case_id' => CourtCase::inRandomOrder()->first()->id,
            'parent_court_case_id' => fake()->randomNumber(),
            'case_number' => fake()->optional()->word,
            'court_case_open_date' => fake()->optional()->date(),
            'court_case_close_date' => fake()->optional()->date(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
