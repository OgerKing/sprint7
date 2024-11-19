<?php

namespace Database\Seeders;

use App\Models\WratsUser;
use Illuminate\Database\Seeder;

class WratsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WratsUser::factory()->count(9)->create();
    }
}
