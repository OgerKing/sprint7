<?php

namespace Database\Seeders;

use App\Models\AdjudicationStatus;
use Illuminate\Database\Seeder;

class AdjudicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Hydrographic Survey',
            'created_by' => 'Rguidi',
            'updated_by' => 'RGuidi',
            'created_at' => '2024-07-06 10:23:27',
            'updated_at' => '2024-07-06 10:23:27',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Active Adjudication',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-06 10:23:47',
            'updated_at' => '2024-07-06 10:23:47',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Inter Se',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-06 10:24:04',
            'updated_at' => '2024-07-06 10:24:04',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Final Decree',
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'created_at' => '2024-07-06 10:24:27',
            'updated_at' => '2024-07-06 10:24:27',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Post Final Decree',
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'created_at' => '2024-07-06 10:24:44',
            'updated_at' => '2024-07-06 10:24:44',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Settlement',
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'created_at' => '2024-07-06 10:25:01',
            'updated_at' => '2024-07-06 10:25:01',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Archived',
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'created_at' => '2024-07-06 10:25:16',
            'updated_at' => '2024-07-06 10:25:16',
        ]);

        AdjudicationStatus::factory()->create([
            'adjudication_status_description' => 'Partial Final Decree',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-12 08:48:21',
            'updated_at' => '2024-07-12 08:48:21',
        ]);
    }
}
