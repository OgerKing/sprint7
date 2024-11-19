<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    protected $model = Action::class;

    public function definition()
    {
        return [
            'action_code' => $this->faker->unique()->regexify('[A-Z]{5}'),
            'action_description' => $this->faker->sentence(4),
            'created_by' => $this->faker->userName,
            'updated_by' => $this->faker->userName,
        ];
    }
}
