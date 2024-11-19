<?php

namespace Database\Factories;

use App\Models\Court;
use App\Models\CourtCase;
use App\Models\CourtPersonnel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtCaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourtCase::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'court_id' => Court::factory(),
            'case_number' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'case_name' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'court_docket_link' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'docket_number' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'court_judge_id' => CourtPersonnel::factory(),
            'court_master_id' => CourtPersonnel::factory(),
            'court_case_open_date' => $this->faker->date(),
            'court_case_close_date' => $this->faker->date(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
        ];
    }
}
