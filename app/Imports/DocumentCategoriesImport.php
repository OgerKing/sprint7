<?php

namespace App\Imports;

use App\Models\DocumentCategory;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocumentCategoriesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DocumentCategory([
            'document_category_code' => $row['document_category_code'],
            'document_category_description' => $row['document_category_description'],
            'sort' => $row['sort'],
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],
            // 'is_deleted' => $row['is_deleted'],
            // 'created_at' => strtolower($row['created_at']) === 'NULL' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            // 'updated_at' => strtolower($row['updated_at']) === 'NULL' ? null : ($row['updated_at'] ? Carbon::parse($row['updated_at']) : null),
        ]);
    }
}
