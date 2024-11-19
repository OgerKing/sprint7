<?php

namespace Database\Factories;

use App\Models\RoleHasPermission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\RoleHasPermission>
 */
final class RoleHasPermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleHasPermission::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'permission_id' => \App\Models\Permission::factory(),
            'role_id' => \App\Models\Role::factory(),
        ];
    }
}
