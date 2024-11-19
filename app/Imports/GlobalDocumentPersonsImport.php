<?php

namespace App\Imports;

use App\Models\GlobalDocumentPerson;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GlobalDocumentPersonsImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new GlobalDocumentPerson([
            'global_document_id' => $row['global_document_id'],
            'person_id' => $row['person_id'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'] === 'NULL' ? null : Carbon::parse($row['updated_at']),
            'updated_by' => $row['updated_by'],
        ]);
    }
}
