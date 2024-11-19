<?php

namespace App\Imports;

use App\Models\Pod;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PodImport implements ToModel, WithChunkReading, WithHeadingRow
{
    // Counter to track the number of rows processed
    private $rowCount = 0;

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Pod([
            'id' => $row['id'],
            's_type_cat' => $row['s_type_cat'],
            'pod_name' => $row['pod_name'],
            'pod_subfile' => $row['pod_subfile'],
            'pod_map_txt' => $row['pod_map_txt'],
            'pod_tract_txt' => $row['pod_tract_txt'],
            'qtr_4th' => $row['qtr_4th'],
            'qtr_16th' => $row['qtr_16th'],
            'qtr_64th' => $row['qtr_64th'],
            'sub_sec_txt' => $row['sub_sec_txt'],
            'sec' => $row['sec'],
            'tws' => $row['tws'],
            'rng' => $row['rng'],
            'x' => $row['x'],
            'y' => $row['y'],
            'xy_datum' => $row['xy_datum'],
            'xy_unit_of_measure' => $row['xy_unit_of_measure'],
            'zone' => $row['zone'],
            'map_id_desc' => $row['map_id_desc'],
            'f_photo_nbr' => $row['f_photo_nbr'],
            'well_define' => $row['well_define'],
            'pod_loc_date' => $row['pod_loc_date'],
            'pod_loc_time' => $row['pod_loc_time'],
            'plss_description' => $row['plss_description'],
            'crew_nbr' => $row['crew_nbr'],
            'point_qual' => $row['point_qual'],
            'std_dev' => $row['std_dev'],
            'pod_basin' => $row['pod_basin'],
            'pod_nbr' => $row['pod_nbr'],
            'pod_suffix' => $row['pod_suffix'],
            'ose_file' => $row['ose_file'],
            'pod_hl_txt' => $row['pod_hl_txt'],
            'pod_field_no' => $row['pod_field_no'],
            'lot' => $row['lot'],
            'pod_location_description' => $row['pod_location_description'],
            'waters_pod_id' => $row['waters_pod_id'],
            's_id_access' => $row['s_id_access'],
            'selected' => $row['selected'],
            'map_qtr' => $row['map_qtr'],
            'lat_deg' => $row['lat_deg'],
            'lat_min' => $row['lat_min'],
            'lat_sec' => $row['lat_sec'],
            'lon_deg' => $row['lon_deg'],
            'lon_min' => $row['lon_min'],
            'lon_sec' => $row['lon_sec'],
            'location_data_source' => $row['location_data_source'],
            'pod_type_id' => $row['pod_type_id'],
            'created_at' => $row['created_at'],
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'],
            'updated_by' => $row['updated_by'],
            'county_id' => $row['county_id'],
            'source_ArcGIS' => $row['source_ArcGIS'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1;
    }

    // Implement the limit to stop after a certain number of rows
    public function limit(): int
    {
        return 1;
    }
}
