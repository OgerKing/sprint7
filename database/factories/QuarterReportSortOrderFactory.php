<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuarterReportSortOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adjudications_section_id' => \App\Models\AdjudicationSection::factory(),
            'row_order_id' => $this->faker->randomDigitNotNull(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
