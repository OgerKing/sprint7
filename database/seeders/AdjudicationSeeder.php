<?php

namespace Database\Seeders;

use App\Models\Adjudication;
use Illuminate\Database\Seeder;

class AdjudicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Adjudication::factory()->create([
            'id' => 1,
            'adjudication_name' => 'Nambe, Pojoaque Tesuque Basin(Aamodt)',
            'adjudication_nickname' => 'NPT',
            'bureau_id' => 1,
            'adjudication_status_id' => 4,
            'adjudication_district_id' => 1,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => null,
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 2,
            'adjudication_name' => 'Animas Valley Underground',
            'adjudication_nickname' => 'AUB',
            'bureau_id' => 2,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 2,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_animas.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 3,
            'adjudication_name' => 'Pecos River Stream System  (Lewis)',
            'adjudication_nickname' => 'PECOS',
            'bureau_id' => 1,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 7,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => null,
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 4,
            'adjudication_name' => 'Rio Chama Stream System (Aragon)',
            'adjudication_nickname' => 'CH',
            'bureau_id' => 1,
            'adjudication_status_id' => 8, //TODO: the excel sheet has this as a nine
            'adjudication_district_id' => 3,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_rio-chama.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 7,
            'adjudication_name' => 'Jemez River Stream System (Abousleman)',
            'adjudication_nickname' => 'JMZ',
            'bureau_id' => 1,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 4,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => null,
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 8,
            'adjudication_name' => 'Lower Rio Grande',
            'adjudication_nickname' => 'LRG',
            'bureau_id' => 2,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 5,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_LRG.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 12,
            'adjudication_name' => 'Red River Stream System',
            'adjudication_nickname' => 'RR',
            'bureau_id' => 1,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 8,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_RedRiver.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 15,
            'adjudication_name' => 'San Juan River Stream System',
            'adjudication_nickname' => 'San Juan',
            'bureau_id' => 1,
            'adjudication_status_id' => 3,
            'adjudication_district_id' => 9,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_san-juan.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 16,
            'adjudication_name' => 'Santa Cruz/Truchas Rivers Stream System (Abbott)',
            'adjudication_nickname' => 'SCT',
            'bureau_id' => 1,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 10,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => null,
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 17,
            'adjudication_name' => 'Santa Fe River Stream System (Anaya)',
            'adjudication_nickname' => 'SF',
            'bureau_id' => 1,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 11,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_SantaFe_menu.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);

        Adjudication::factory()->create([
            'id' => 18,
            'adjudication_name' => 'Taos Stream System',
            'adjudication_nickname' => 'TS',
            'bureau_id' => 1,
            'adjudication_status_id' => 2,
            'adjudication_district_id' => 12,
            'coordinate_system' => null,
            'adjudication_boundary_map_link' => 'https://www.ose.nm.gov/HydroSurvey/legal_ose_hydro_Taos.php',
            'hydrographic_survey_description' => null,
            'prefix' => null,
        ]);
    }
}
