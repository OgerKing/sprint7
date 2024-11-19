<?php

namespace App\Imports;

use App\Models\DocumentType;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocumentTypesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DocumentType([
            'document_category_id' => $row['document_category_id'],
            'document_type_code' => $row['document_type_code'],
            'document_type_description' => $row['document_type_description'],
            'sort' => $row['sort'],
            'is_deleted' => in_array(trim($row['is_deleted']), ['null', 'NULL']) ? null : ($row['is_deleted'] ? Carbon::parse($row['is_deleted']) : null),
            'created_at' => in_array(trim($row['created_at']), ['null', 'NULL']) ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'updated_at' => in_array(trim($row['updated_at']), ['null', 'NULL']) ? null : ($row['updated_at'] ? Carbon::parse($row['updated_at']) : null),
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],

        ]);
    }
}
