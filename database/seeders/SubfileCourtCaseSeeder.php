<?php

namespace Database\Seeders;

use App\Models\Subfile;
use App\Models\SubfileCourtCase;
use Illuminate\Database\Seeder;

class SubfileCourtCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 101675,
                's_type_cat' => 'S',
                'pod_name' => null,
                'pod_subfile' => null,
                'pod_map_txt' => null,
                'pod_tract_txt' => '4',
                'qtr_4th' => '4',
                'qtr_16th' => '3',
                'qtr_64th' => null,
                'sub_sec_txt' => '07',
                'sec' => '19N',
                'tws' => '09E',
                'x' => null,
                'y' => null,
                'xy_datum' => 'NAD27',
                'xy_unit_of_measure' => null,
                'zone' => 'C',
                'map_id_desc' => null,
                'f_photo_nbr' => null,
                'well_define' => null,
                'pod_loc_date' => null,
                'pod_loc_time' => null,
                'plss_description' => null,
                'crew_nbr' => null,
                'point_qual' => 'SD',
                'std_dev' => '00000',
                'pod_basin' => null,
                'pod_nbr' => null,
                'pod_suffix' => null,
                'ose_file' => null,
                'pod_hl_txt' => null,
                'pod_field_no' => null,
                'lot' => null,
                'pod_location_description' => null,
                'waters_pod_id' => 2,
                's_id_access' => 0,
                'selected' => null,
                'map_qtr' => null,
                'lat_deg' => null,
                'lat_min' => null,
                'lat_sec' => null,
                'lon_deg' => null,
                'lon_min' => null,
                'lon_sec' => null,
                'location_data_source' => null,
                'arcgis_processing_id' => null,
                'pod_type_id' => 2,
                'created_at' => null,
                'created_by' => 'Rguidi',
                'updated_at' => null,
                'updated_by' => 'Rguidi',
            ],
            [
                'id' => 101676,
                's_type_cat' => 'S',
                'pod_name' => null,
                'pod_subfile' => null,
                'pod_map_txt' => null,
                'pod_tract_txt' => '4',
                'qtr_4th' => '4',
                'qtr_16th' => '1',
                'qtr_64th' => null,
                'sub_sec_txt' => '31',
                'sec' => '18N',
                'tws' => '10E',
                'x' => null,
                'y' => null,
                'xy_datum' => 'NAD27',
                'xy_unit_of_measure' => null,
                'zone' => 'C',
                'map_id_desc' => null,
                'f_photo_nbr' => null,
                'well_define' => null,
                'pod_loc_date' => null,
                'pod_loc_time' => null,
                'plss_description' => null,
                'crew_nbr' => null,
                'point_qual' => 'SD',
                'std_dev' => '00000',
                'pod_basin' => null,
                'pod_nbr' => null,
                'pod_suffix' => null,
                'ose_file' => null,
                'pod_hl_txt' => null,
                'pod_field_no' => null,
                'lot' => null,
                'pod_location_description' => null,
                'waters_pod_id' => 3,
                's_id_access' => 0,
                'selected' => null,
                'map_qtr' => null,
                'lat_deg' => null,
                'lat_min' => null,
                'lat_sec' => null,
                'lon_deg' => null,
                'lon_min' => null,
                'lon_sec' => null,
                'location_data_source' => null,
                'arcgis_processing_id' => null,
                'pod_type_id' => 2,
                'created_at' => null,
                'created_by' => 'Rguidi',
                'updated_at' => null,
                'updated_by' => 'Rguidi',
            ],
        ];

        $subfileIds = Subfile::pluck('id');

        foreach ($subfileIds as $id) {
            SubfileCourtCase::factory()->create([
                'subfile_id' => $id,
            ]);
        }
    }
}
