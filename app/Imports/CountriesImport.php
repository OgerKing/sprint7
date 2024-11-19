<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountriesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Country([
            'id' => $row['id'],
            'country_name' => $row['country_name'],
            'created_at' => $row['created_at'],
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'],
            'updated_by' => $row['updated_by'],
        ]);
    }
}
