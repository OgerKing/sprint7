<?php

namespace App\Imports;

use App\Models\PersonAliasType;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonAliasTypesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PersonAliasType([
            'id' => $row['id'],
            'person_alias_type_name' => $row['person_alias_type_name'],
            'created_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'created_by' => $row['created_by'],
            'updated_at' => strtolower($row['created_at']) === 'null' ? null : ($row['created_at'] ? Carbon::parse($row['created_at']) : null),
            'updated_by' => $row['updated_by'],
        ]);
    }
}
