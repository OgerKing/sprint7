<?php

namespace App\Imports;

use App\Models\AdjudicationSectionStatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdjudicationSectionStatusImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AdjudicationSectionStatus([
            'adjudication_section_status_description' => $row['adjudication_section_status_description'],
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],

        ]);
    }
}
