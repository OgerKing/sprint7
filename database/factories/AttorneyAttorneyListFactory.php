<?php

namespace Database\Factories;

use App\Models\Attorney;
use App\Models\AttorneyAttorneyList;
use App\Models\AttorneyList;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttorneyAttorneyListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttorneyAttorneyList::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'attorney_list_id' => AttorneyList::factory(),
            'attorney_id' => Attorney::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
