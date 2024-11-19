<?php

namespace App\Imports;

use App\Models\SubfileAdjudicationStatus;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubfileAdjudicationStatusesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SubfileAdjudicationStatus([
            'subfile_adjudication_status_code' => $row['subfile_adjudication_status_code'],
            'subfile_adjudication_status_description' => $row['subfile_adjudication_status_description'],
            'sort' => 1,
            'created_by' => $row['created_by'],
            'updated_by' => $row['updated_by'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'updated_at' => strtolower($row['updated_at']) === 'null' ? null : ($row['updated_at'] ? Carbon::parse($row['updated_at']) : null),
        ]);
    }
}
