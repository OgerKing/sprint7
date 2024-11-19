<?php

namespace App\Imports;

use App\Models\Adjudication;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdjudicationImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Adjudication([
            'adjudication_name' => $row['adjudication_name'],
            'adjudication_nickname' => $row['adjudication_nickname'],
            'bureau_id' => $row['bureau_id'],
            'adjudication_status_id' => $row['adjudication_status_id'],
            'adjudication_district_id' => $row['adjudication_district_id'],
            'coordinate_system' => $row['coordinate_system'],
            'adjudication_boundary_map_link' => $row['adjudication_boundary_map_link'],
            'hydrographic_survey_description' => $row['hydrographic_survey_description'],
            'prefix' => $row['prefix'],
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],

        ]);
    }
}
