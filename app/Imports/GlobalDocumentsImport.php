<?php

namespace App\Imports;

use App\Models\GlobalDocument;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GlobalDocumentsImport implements ToModel, WithChunkReading, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new GlobalDocument([
            'id' => $row['id'],
            'adjudication_id' => strtolower($row['adjudication_id']) === 'null' ? null : $row['adjudication_id'],
            'global_document_title' => $row['global_document_title'],
            'document_filing_date' => in_array($row['document_filing_date'], ['null', 'NULL', 'Rguidi']) ? null : ($row['document_filing_date'] ? Carbon::parse($row['document_filing_date']) : null),
            'global_document_type_id' => $row['global_document_type_id'] === 'Rguidi' ? 864 : $row['global_document_type_id'],
            'attachment_URL' => $row['attachment_URL'] ?? null,
            'docket_id' => $row['docket_id'],
            'global_desc' => $row['global_desc'],
            'global_id_access' => $row['global_id_access'] === 'NULL' ? null : $row['global_id_access'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'attachment_file_path' => $row['attachment_file_path'],
            // 'created_by'     => $row['created_by'],
            // 'updated_at'     => $row['updated_at'] ? Carbon::parse($row['updated_at']) : null,
            // 'updated_by'     => $row['updated_by'],

        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
