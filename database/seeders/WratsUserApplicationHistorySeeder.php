<?php

namespace Database\Seeders;

use App\Models\WratsUserApplicationHistory;
use Illuminate\Database\Seeder;

class WratsUserApplicationHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WratsUserApplicationHistory::factory()->count(20)->create();
    }
}
