<?php

namespace Database\Seeders;

use App\Models\GlobalDocument;
use App\Models\GlobalDocumentSubfile;
use Illuminate\Database\Seeder;

class GlobalDocumentSubfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get list of all global document ids
        $globalDocumentIds = GlobalDocument::pluck('id');

        foreach ($globalDocumentIds as $id) {
            GlobalDocumentSubfile::factory()->create([
                'global_document_id' => $id,
            ]);
        }
    }
}
