<?php

namespace Database\Factories;

use App\Models\FileLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileLocation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'file_location_description' => $this->faker->regexify('[A-Za-z0-9]{36}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
