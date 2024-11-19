<?php

namespace Database\Factories;

use App\Models\DocumentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\DocumentCategory>
 */
final class DocumentCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'document_category_code' => $this->faker->lexify('???'),
            'document_category_description' => fake()->word,
            'sort' => fake()->randomNumber(),
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
