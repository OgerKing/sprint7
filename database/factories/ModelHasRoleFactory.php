<?php

namespace Database\Factories;

use App\Models\ModelHasRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ModelHasRole>
 */
final class ModelHasRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelHasRole::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'role_id' => \App\Models\Role::factory(),
            'model_type' => fake()->word,
            'model_id' => fake()->randomNumber(),
        ];
    }
}
