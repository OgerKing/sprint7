<?php

namespace App\Imports;

use App\Models\County;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountiesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new County([
            'id' => $row['id'],
            'county' => $row['county'],
            'county_name' => $row['county_name'],
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],
        ]);
    }
}
