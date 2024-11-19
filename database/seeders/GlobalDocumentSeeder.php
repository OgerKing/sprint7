<?php

namespace Database\Seeders;

use App\Models\GlobalDocument;
use Illuminate\Database\Seeder;

class GlobalDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalDocument::factory()->count(9)->create();
    }
}
