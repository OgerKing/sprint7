<?php

namespace Database\Seeders;

use App\Models\GlobalDocument;
use App\Models\GlobalDocumentPOU;
use App\Models\Pou;
use Illuminate\Database\Seeder;

class GlobalDocumentPOUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalDocumentPOU::factory()
            ->recycle(GlobalDocument::all())
            ->recycle(Pou::all())
            ->count(100)
            ->create();
    }
}
