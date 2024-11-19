<?php

namespace Database\Factories;

use App\Models\PouComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PouCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PouComment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'pou_comment_date' => $this->faker->date(),
            'pou_comment_description' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'pou_comment_resource' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'pou_comment_type' => $this->faker->regexify('[A-Za-z0-9]{36}'),
            'pou_id' => $this->faker->randomLetter(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'work_notes' => $this->faker->regexify('[A-Za-z0-9]{100}'),
        ];
    }
}
