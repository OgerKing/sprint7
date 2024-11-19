<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Court::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $courtNames = ['NM Fifth Judicial District Court', 'US District Court 10'];
        $courtTypes = ['state'];

        return [
            'court_name' => $this->faker->randomElement($courtNames),
            'court_jurisdiction' => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'court_type' => $this->faker->randomElement($courtTypes),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
