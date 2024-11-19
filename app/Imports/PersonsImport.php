<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class PersonsImport implements ToModel, WithChunkReading, WithHeadingRow, WithLimit
{
    // Only read the first 500 rows, too many rows otherwise.
    private $rowCount = 0;

    private const ROW_LIMIT = 10;

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Increment the counter
        $this->rowCount++;

        // Stop processing once the limit is reached
        if ($this->rowCount > self::ROW_LIMIT) {
            return null;
        }

        return new Person([
            'id' => $row['id'],
            'person_type_id' => $row['person_type_id'],
            'person_subtype_id' => $row['person_subtype_id'],
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'suffix' => $row['suffix'],
            'person_start_date' => $row['person_start_date'],
            'person_end_date' => $row['person_end_date'],
            'person_status_id' => $row['person_status_id'],
            'is_deceased' => $row['is_deceased'],
            'verified' => $row['verified'],
            'person_address_id' => $row['person_address_id'],
            'person_email_id' => $row['person_email_id'],
            'person_telephone_id' => $row['person_telephone_id'],
            'special_handling_instructions' => $row['special_handling_instructions'],
            'department' => $row['department'],
            'division' => $row['division'],
            'entity_name' => $row['entity_name'],
            'created_at' => $row['created_at'],
            'created_by' => $row['created_by'],
            'updated_at' => $row['updated_at'],
            'updated_by' => $row['updated_by'],
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }

    // Implement the limit to stop after a certain number of rows
    public function limit(): int
    {
        return self::ROW_LIMIT;
    }
}
