<?php

namespace Database\Seeders;

use App\Models\DefendantDocument;
use Illuminate\Database\Seeder;

class DefendantDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DefendantDocument::factory()->create([
            'id' => 141338,
            'document_title' => 'Document 1',  // No document title in this row
            'person_id' => 207457,
            'document_filing_date' => 25286,  // Assuming this is a date or timestamp; adjust format as needed
            'attachment_URL' => null,
            'document_type_id' => 383,
            'defendant' => 0,
            'docket_id' => 1,
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'attachment_file_path' => 'attatchment_test_path',
            'subfile_id' => 1,

        ]);

        DefendantDocument::factory()->create([
            'id' => 141339,
            'document_title' => 'Document 2',  // No document title in this row
            'person_id' => 207458,
            'document_filing_date' => 37313,  // Adjust format if needed
            'attachment_URL' => null,
            'document_type_id' => 367,
            'defendant' => 0,
            'docket_id' => 1,
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'attachment_file_path' => 'attatchment_test_path',
            'subfile_id' => 1,
        ]);

        DefendantDocument::factory()->create([
            'id' => 141340,
            'document_title' => 'Document 3',  // No document title in this row
            'person_id' => 207459,
            'document_filing_date' => 24310,  // Adjust format if needed
            'attachment_URL' => null,
            'document_type_id' => 367, //TODO: schema name change to defendant_document_type_id
            'defendant' => 0,
            'docket_id' => 1,
            'created_by' => 'RGuidi',
            'updated_by' => 'RGuidi',
            'attachment_file_path' => 'attatchment_test_path',
            'subfile_id' => 1, //TODO: schema change should remove this

        ]);
    }
}
