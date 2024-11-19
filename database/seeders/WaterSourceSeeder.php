<?php

namespace Database\Seeders;

use App\Models\WaterSource;
use Illuminate\Database\Seeder;

class WaterSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WaterSource::factory()->create([
            'water_source_code' => 'OT',
            'water_source_description' => 'Anything else',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-08 13:11:17.150',
            'updated_at' => '2024-07-08 13:11:17.150',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'FO',
            'water_source_description' => 'Floodwater Only',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-08 13:11:17.150',
            'updated_at' => '2024-07-08 13:11:17.150',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'CO',
            'water_source_description' => 'Groundwater & Surface Water Combined',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-08 13:11:17.150',
            'updated_at' => '2024-07-08 13:11:17.150',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'GO',
            'water_source_description' => 'Groundwater Only',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-08 13:11:17.150',
            'updated_at' => '2024-07-08 13:11:17.150',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'SG',
            'water_source_description' => 'Surface Water & Supplemental Groundwater Combined',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-08 13:11:17.150',
            'updated_at' => '2024-07-08 13:11:17.150',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'SO',
            'water_source_description' => 'Surface Water Only',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-08 13:11:17.150',
            'updated_at' => '2024-07-08 13:11:17.150',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'HUC8',
            'water_source_description' => 'Hydrologic Unit Code',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-15 15:08:13.523',
            'updated_at' => '2024-07-15 15:08:13.523',
        ]);

        WaterSource::factory()->create([
            'water_source_code' => 'WS',
            'water_source_description' => 'Watershed',
            'created_by' => 'Rguidi',
            'updated_by' => 'Rguidi',
            'created_at' => '2024-07-15 15:08:26.537',
            'updated_at' => '2024-07-15 15:08:26.537',
        ]);
    }
}
