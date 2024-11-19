<?php

namespace Database\Factories;

use App\Models\WaterRightCommentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaterRightCommentCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaterRightCommentCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->randomLetter(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
