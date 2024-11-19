<?php

namespace App\Imports;

use App\Models\ArcgisProcessing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArcgisProcessingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row): ArcgisProcessing              
    {
        return new ArcgisProcessing([
            'id' => $row['id'],
            'adjudication_id' => $row['adjudication_id'],
            'access_gis' => $row['access_gis'],
            'gis' => $row['gis'],
            'gis_dir' => $row['gis_dir'],
            'created_by' => $row['created_by'] === null ? 'Rich' : $row['created_by'],
            'updated_by' => $row['updated_by'] === null ? 'Rich' : $row['updated_by'],
            'created_at' => $row['created_at'],
        ]);
    }
}
