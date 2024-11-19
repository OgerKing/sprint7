<?php

namespace Database\Seeders;

use App\Models\HydrographicDocument;
use Illuminate\Database\Seeder;

class HydrographicDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HydrographicDocument::factory()->count(9)->create();
    }
}
