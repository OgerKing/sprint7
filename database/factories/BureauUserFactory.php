<?php

namespace Database\Factories;

use App\Models\Bureau;
use App\Models\GisDuplicate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BureauUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bureau_id' => Bureau::factory(),
            'gis_duplicate_id' => GisDuplicate::factory(),
            'user_id' => User::factory(),
            'login_name' => $this->faker->word(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
