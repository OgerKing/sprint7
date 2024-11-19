<?php

namespace Database\Seeders;

use App\Models\AdjudicationSectionType;
use Illuminate\Database\Seeder;

class AdjudicationSectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionTypes = [
            ['code' => 'ASB', 'description' => 'Adjudication Stream System Boundary'],
            ['code' => 'AS', 'description' => 'Description=Adjudication Section(s)'],
            ['code' => 'PTNS', 'description' => 'Adjudication PTN Section(s)'],
            ['code' => 'SUB', 'description' => 'Adjudication Sub-Section(s)'],
            ['code' => 'SS', 'description' => 'Stream System or Surface Water Basin'],
            ['code' => 'SSUB', 'description' => 'Description=Surface Water Sub-Basin (HUC 8)'],
            ['code' => 'GWB', 'description' => 'Groundwater Basin'],
        ];

        foreach ($sectionTypes as $sectionType) {
            AdjudicationSectionType::factory()->create([
                'adjudication_section_type_code' => $sectionType['code'],
                'adjudication_section_type_description' => $sectionType['description'],
            ]);
        }
    }
}
