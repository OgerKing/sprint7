<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileUserWatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subfile_id' => \App\Models\Subfile::factory(),
            'wrats_user_id' => \App\Models\WratsUser::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
