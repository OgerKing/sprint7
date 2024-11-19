<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileAttorneyNoteFactory extends Factory
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
            'subfile_attorney_note' => $this->faker->word(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
