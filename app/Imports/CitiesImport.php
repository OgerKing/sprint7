<?php

namespace App\Imports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CitiesImport implements ToModel, WithChunkReading, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new City([
            'id' => $row['id'],
            'city_name' => $row['city_name'],
            'state_id' => $row['state_id'],
            'created_at' => $row['created_at'],
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'],
            'updated_by' => $row['updated_by'],
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
