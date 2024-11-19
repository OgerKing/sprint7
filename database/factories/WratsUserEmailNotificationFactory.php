<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WratsUserEmailNotificationFactory extends Factory
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
            'email_sent_address' => $this->faker->word(),
            'email_sent_at' => $this->faker->dateTime(),
            'email_sent_subject' => $this->faker->word(),
            'created_by' => $this->faker->word(),
            'updated_by' => $this->faker->word(),
        ];
    }
}
