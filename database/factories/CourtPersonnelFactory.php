<?php

namespace Database\Factories;

use App\Models\Court;
use App\Models\CourtRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtPersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'court_role_id' => CourtRole::inRandomOrder()->first()->id,
            'court_id' => Court::inRandomOrder()->first()->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
