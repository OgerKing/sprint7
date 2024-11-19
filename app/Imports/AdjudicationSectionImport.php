<?php

namespace App\Imports;

use App\Models\AdjudicationSection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdjudicationSectionImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AdjudicationSection([
            'adjudication_id' => $row['adjudication_id'],
            'adjudication_section_name' => $row['adjudication_section_name'],
            'prefix' => $row['prefix'],
            'adjudication_section_type_id' => $row['adjudication_section_type_id'] === null ? 4 : $row['adjudication_section_type_id'],
            'boundary_name' => $row['boundary_name'],
            'adjudication_section_status_id' => $row['adjudication_section_status_id'] === null ? 9 : $row['adjudication_section_status_id'],
            'water_source_id' => $row['water_source_id'] === null ? 3 : $row['water_source_id'],
            'basin_section' => in_array(trim($row['basin_section']), ['null', 'NULL']) ? null : ($row['basin_section'] ? Carbon::parse($row['basin_section']) : null),
            'extra_sub_file_tab' => in_array(trim($row['extra_sub_file_tab']), ['null', 'NULL']) ? null : ($row['extra_sub_file_tab'] ? $row['extra_sub_file_tab'] : null),
            'show_estate' => in_array(trim($row['show_estate']), ['null', 'NULL']) ? null : ($row['show_estate'] ? $row['show_estate'] : null),
            'program' => $row['program'],
            'created_by' => $row['created_by'] === null ? 'Rich' : $row['created_by'],
            'updated_by' => $row['updated_by'] === null ? 'Rich' : $row['updated_by'],
            'created_at' => $row['created_at'],
            // 'updated_at'    => $row['updated_at']

        ]);
    }
}
