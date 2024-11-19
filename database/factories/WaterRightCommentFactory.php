<?php

namespace Database\Factories;

use App\Models\WaterRight;
use App\Models\WaterRightComment;
use App\Models\WaterRightGlobalDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaterRightCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaterRightComment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'ose_resource' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'water_right_comment' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'water_right_comment_category_id' => $this->faker->randomLetter(),
            'water_right_global_documents_id' => WaterRightGlobalDocument::factory(),
            'water_right_id' => WaterRight::factory(),
        ];
    }
}
