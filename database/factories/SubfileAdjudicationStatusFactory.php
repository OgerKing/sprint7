<?php

namespace Database\Factories;

use App\Models\SubfileAdjudicationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileAdjudicationStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubfileAdjudicationStatus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_adjudication_status_code' => $this->faker->randomLetter(),
            'subfile_adjudication_status_description' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'sort' => $this->faker->numberBetween(-100000, 100000),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
