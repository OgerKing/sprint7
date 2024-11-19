<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobBatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'total_jobs' => $this->faker->randomNumber(),
            'pending_jobs' => $this->faker->randomNumber(),
            'failed_jobs' => $this->faker->randomNumber(),
            'failed_job_ids' => $this->faker->text(),
            'created_at' => $this->faker->randomNumber(),
        ];
    }
}
