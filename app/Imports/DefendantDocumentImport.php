<?php

namespace App\Imports;

use App\Models\DefendantDocument;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DefendantDocumentImport implements ToModel, WithChunkReading, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DefendantDocument([
            'document_title' => $row['document_title'],
            'person_id' => $row['person_id'],
            'document_filing_date' => $row['document_filing_date'],
            'attachment_URL' => $row['attachment_URL'],
            'defendant_document_type_id' => $row['defendant_document_type_id'],
            'defendant' => $row['defendant'],
            'docket_id' => $row['docket_id'],
            'created_at' => $row['created_at'],
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'],
            'updated_by' => $row['updated_by'],
            'attachment_file_path' => $row['attachment_file_path'],
        ]);
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
