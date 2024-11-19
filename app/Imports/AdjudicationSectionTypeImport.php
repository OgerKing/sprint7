<?php

namespace App\Imports;

use App\Models\AdjudicationSectionType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdjudicationSectionTypeImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AdjudicationSectionType([
            'adjudication_section_type_code' => $row['adjudication_section_type_code'],
            'adjudication_section_type_description' => $row['adjudication_section_type_description'],
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],

        ]);
    }
}
