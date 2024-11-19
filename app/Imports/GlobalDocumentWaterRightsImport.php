<?php

namespace App\Imports;

use App\Models\GlobalDocumentWaterRight;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GlobalDocumentWaterRightsImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new GlobalDocumentWaterRight([
            'global_document_id' => $row['global_document_id'],
            'water_right_id' => $row['water_right_id'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'created_by' => $row['created_by'],
            'updated_at' => in_array(trim($row['updated_at']), ['null', 'NULL', 'NUL']) ? null : ($row['updated_at'] ? Carbon::parse($row['updated_at']) : null),
            'updated_by' => $row['updated_by'] === null ? 'RGuidi' : $row['updated_by'],
        ]);
    }
}
