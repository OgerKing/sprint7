<?php

namespace Database\Seeders;

use App\Models\AdjudicationDocument;
use Illuminate\Database\Seeder;

class AdjudicationDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdjudicationDocument::factory()->count(9)->create();
    }
}
