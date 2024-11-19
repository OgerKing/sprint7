<?php

namespace Database\Factories;

use App\Models\ClaimFieldCheck;
use App\Models\FieldWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimFieldCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClaimFieldCheck::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'field_work_code' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'field_work_id' => FieldWork::factory(),
            'fld_work_notes' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
            'fld_wrk_date' => $this->faker->dateTime(),
            'fld_wrk_id' => $this->faker->randomNumber(),
            'resource_id' => $this->faker->randomNumber(),
            'sub_id' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
