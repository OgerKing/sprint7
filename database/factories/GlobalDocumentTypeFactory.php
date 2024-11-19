<?php

namespace Database\Factories;

use App\Models\GlobalDocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class GlobalDocumentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalDocumentType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'global_document_type_description' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{10}'),
        ];
    }
}
