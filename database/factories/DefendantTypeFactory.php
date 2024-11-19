<?php

namespace Database\Factories;

use App\Models\DefendantType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\DefendantType>
 */
final class DefendantTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DefendantType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => fake()->word,
            'defendant_type_description' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
