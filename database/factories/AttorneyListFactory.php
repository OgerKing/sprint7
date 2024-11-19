<?php

namespace Database\Factories;

use App\Models\AttorneyList;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttorneyListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttorneyList::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'attorney_list_name' => $this->faker->regexify('[A-Za-z0-9]{32}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
