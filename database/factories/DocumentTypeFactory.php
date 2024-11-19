<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\DocumentType>
 */
final class DocumentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'document_category_id' => \App\Models\DocumentCategory::factory(),
            'document_type_code' => $this->faker->lexify('??????'),
            'document_type_description' => fake()->word,
            'sort' => fake()->optional()->randomNumber(),
            'is_deleted' => fake()->optional()->dateTime(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
