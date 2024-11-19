<?php

namespace Database\Factories;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Audit>
 */
final class AuditFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Audit::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_type' => fake()->optional()->word,

            'user_id' => User::factory(),
            'event' => fake()->word,
            'auditable_type' => fake()->word,
            'auditable_id' => fake()->randomNumber(),
            'old_values' => fake()->optional()->text,
            'new_values' => fake()->optional()->text,
            'url' => fake()->optional()->url,
            'ip_address' => fake()->optional()->word,
            'user_agent' => fake()->optional()->userAgent,
            'tags' => fake()->optional()->word,
        ];
    }
}
