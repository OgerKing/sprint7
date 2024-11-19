<?php

namespace Database\Seeders;

use App\Models\PersonType;
use App\Models\PersonTypeSubtype;
use Illuminate\Database\Seeder;

class PersonTypesSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Natural Person' => [],
            'Artificial Person' => ['Corporation', 'Partnership', 'Trust', 'Estate', 'Other'],
            'Public Body' => ['City/County/Municipality', 'Department', 'Division', 'Irrigation District', 'Ditch Association'],
            'Native American Communities' => ['Pueblo', 'Tribe', 'Nation'],
        ];

        foreach ($types as $type => $subtypes) {
            $personType = PersonType::factory()->create(['person_type_name' => $type]);
            foreach ($subtypes as $subtype) {
                $personSubtype = PersonTypeSubtype::factory()->recycle($personType)
                    ->create(['person_type_subtype_name' => $subtype]);
            }
        }
    }
}
