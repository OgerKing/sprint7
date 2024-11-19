<?php

namespace App\Imports;

use App\Models\Attorney;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttorneysImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Attorney
    {
        return new Attorney([
            'last_name' => $row['last_name'],
            'first_name' => strtolower($row['first_name']) === 'null' || '.' ? 'No Data' : $row['first_name'],
            'middle_Initial' => strtolower($row['middle_initial']) === 'null' ? null : $row['middle_initial'],
            'title' => $row['title'],
            'firm' => $row['firm'],
            'firm_department' => $row['firm_department'],
            'office_address' => $row['office_address'],
            'office_address2' => $row['office_address2'],
            'office_city' => $row['office_city'],
            'office_state' => strtolower($row['office_state']) === 'null' ? null : $row['office_state'],
            'office_zip' => $row['office_zip'],
            'office_phone' => $row['office_phone'],
            'office_fax' => $row['office_fax'],
            'office_email' => $row['office_email'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : $row['created_at'],
            'created_by' => strtolower($row['created_by']) === 'null' ? null : $row['created_by'],
            'updated_at' => strtolower($row['updated_at']) === 'null' ? null : $row['updated_at'],
            'updated_by' => strtolower($row['updated_by']) === 'null' ? null : $row['updated_by'],
            // 'deleted_at' => strtolower($row['deleted_at']) === 'null' ? null : $row['deleted_at'],
        ]);
    }
}
