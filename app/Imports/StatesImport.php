<?php

namespace App\Imports;

use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StatesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new State([
            'id' => $row['id'],
            'country_id' => $row['country_id'],
            'state_abbreviation' => $row['state_abbreviation'],
            'state_name' => $row['state_name'],
            'created_at' => $row['created_at'],
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'],
            'updated_by' => $row['updated_by'],
        ]);
    }
}
