<?php

namespace Database\Seeders;

use App\Models\AdjudicationSectionStatus;
use Illuminate\Database\Seeder;

class AdjudicationSectionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTypes = ['Adjudication', 'Archived', 'Final Decree', 'Hydrographic Survey', 'Inter Se', 'Judicial', 'Post Final Decree', 'Settlement'];
        foreach ($statusTypes as $description) {
            AdjudicationSectionStatus::factory()->create(['adjudication_section_status_description' => $description]);
        }
    }
}
