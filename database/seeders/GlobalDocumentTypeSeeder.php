<?php

namespace Database\Seeders;

use App\Models\GlobalDocumentType;
use Illuminate\Database\Seeder;

class GlobalDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalDocumentType::factory()->create([
            'created_by' => 1,
            'global_document_type_description' => 'Global Document',
        ]);
    }
}
