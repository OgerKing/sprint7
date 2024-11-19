<?php

namespace Database\Factories;

use App\Models\AdjudicationSectionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdjudicationSectionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjudicationSectionType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'adjudication_section_type_code' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'adjudication_section_type_description' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
