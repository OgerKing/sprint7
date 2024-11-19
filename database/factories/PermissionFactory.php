<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'deny_read_write' => $this->faker->numberBetween(-8, 8),
            'p_read' => $this->faker->numberBetween(-8, 8),
            'p_write' => $this->faker->numberBetween(-8, 8),
            'role_id' => $this->faker->randomNumber(),
            'securable_id' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
