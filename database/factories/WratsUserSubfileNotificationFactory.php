<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WratsUserSubfileNotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wrats_user_id' => \App\Models\WratsUser::factory(),
            'subfile_id' => \App\Models\Subfile::factory(),
            'file_location_id' => \App\Models\FileLocation::factory(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
