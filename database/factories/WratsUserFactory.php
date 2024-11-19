<?php

namespace Database\Factories;

use App\Models\WratsUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class WratsUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WratsUser::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ad_user_name' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'email' => $this->faker->email(),
            'email_verified_at' => $this->faker->dateTime(),
        ];
    }
}
