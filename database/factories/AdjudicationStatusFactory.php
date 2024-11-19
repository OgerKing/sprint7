<?php

namespace Database\Factories;

use App\Models\AdjudicationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdjudicationStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjudicationStatus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        $statusTypes = ['Adjudication', 'Archived', 'Final Decree', 'Hydrographic Survey', 'Inter Se', 'Judicial', 'Post Final Decree', 'Settlement'];

        return [
            'adjudication_status_description' => $this->faker->randomElement($statusTypes),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
