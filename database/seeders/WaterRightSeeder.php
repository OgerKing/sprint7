<?php

namespace Database\Seeders;

use App\Models\WaterRight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaterRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pull all distinct water_right_id values from global_document_water_rights table
        $waterRightIds = DB::table('global_document_water_rights')
            ->distinct()
            ->pluck('water_right_id');

        // Loop through the water_right_ids and create WaterRight records
        foreach ($waterRightIds as $id) {
            WaterRight::factory()->create([
                'id' => $id, // Assign the specific water_right_id
            ]);
        }
    }
}
