<?php

namespace Database\Factories;

use App\Models\PouCommentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PouCommentType>
 */
final class PouCommentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PouCommentType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => fake()->randomNumber(),
            'pou_comment_type' => fake()->word,
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
