<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 209819,
                'person_type_id' => 1,
                'person_subtype_id' => null,
                'first_name' => 'R. LEE',
                'middle_name' => null,
                'last_name' => 'AAMODT',
                'suffix' => null,
                'person_start_date' => '00:00.0',
                'person_end_date' => null,
                'person_status_id' => 2,
                'is_deceased' => 0,
                'verified' => 0,
                'person_address_id' => 223601,
                'person_email_id' => null,
                'person_telephone_id' => null,
                'special_handling_instructions' => null,
                'department' => null,
                'division' => null,
                'entity_name' => null,
                'created_at' => null,
                'created_by' => 'RGuidi',
                'updated_at' => null,
                'updated_by' => 'RGuidi',
            ],
            [
                'id' => 209821,
                'person_type_id' => 2,
                'person_subtype_id' => null,
                'first_name' => '',
                'middle_name' => '',
                'last_name' => '',
                'suffix' => null,
                'person_start_date' => '00:00.0',
                'person_end_date' => null,
                'person_status_id' => 2,
                'is_deceased' => 0,
                'verified' => 0,
                'person_address_id' => null,
                'person_email_id' => null,
                'person_telephone_id' => null,
                'special_handling_instructions' => null,
                'department' => null,
                'division' => null,
                'entity_name' => 'COMMUNITY DITCH ASSOC. ACEQUIA BARRANCO BLANCO',
                'created_at' => null,
                'created_by' => 'RGuidi',
                'updated_at' => null,
                'updated_by' => 'RGuidi',
            ],
        ];
        foreach ($data as $row) {
            Person::factory()->create($row);
        }
    }
}
