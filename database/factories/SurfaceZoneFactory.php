<?php

namespace Database\Factories;

use App\Models\SurfaceZone;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurfaceZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SurfaceZone::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cir' => $this->faker->randomFloat(0, 0, 9999999999.),
            'cir_' => $this->faker->randomFloat(0, 0, 9999999999.),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'evap_loss' => $this->faker->randomFloat(0, 0, 9999999999.),
            'fdr' => $this->faker->randomFloat(0, 0, 9999999999.),
            'fdr_' => $this->faker->randomFloat(0, 0, 9999999999.),
            'pdr' => $this->faker->randomFloat(0, 0, 9999999999.),
            'pdr_' => $this->faker->randomFloat(0, 0, 9999999999.),
            'surf_zone_description' => $this->faker->regexify('[A-Za-z0-9]{256}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
