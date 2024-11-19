<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run()
    {
        Action::factory()->create([
            'action_code' => 'CREAT',
            'action_description' => 'Create a new record',
        ]);

        Action::factory()->create([
            'action_code' => 'UPDAT',
            'action_description' => 'Update an existing record',
        ]);

        Action::factory()->create([
            'action_code' => 'DELET',
            'action_description' => 'Delete a record',
        ]);

        // Create additional random actions
        Action::factory()->count(7)->create();
    }
}
