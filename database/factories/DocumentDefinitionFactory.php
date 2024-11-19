<?php

namespace Database\Factories;

use App\Models\DocumentDefinition;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentDefinitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentDefinition::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'def_doc_sort' => $this->faker->numberBetween(-1000, 1000),
            'def_doc_status' => $this->faker->randomNumber(),
            'definition' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'document_definition_name' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
