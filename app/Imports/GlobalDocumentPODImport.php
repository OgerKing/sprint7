<?php

namespace App\Imports;

use App\Models\GlobalDocumentPOD;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GlobalDocumentPODImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new GlobalDocumentPOD([
            'global_document_id' => $row['global_document_id'],
            'POD_id' => $row['pod_id'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'] === 'NULL' ? null : Carbon::parse($row['updated_at']),
            'updated_by' => $row['updated_by'],

            //
        ]);
    }
}
