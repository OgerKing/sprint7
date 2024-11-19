<?php

namespace App\Livewire\Forms;

use App\Models\HydrographicDocument;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class HydrographicDocumentsForm extends Form
{
    use WithFileUploads;

    public ?HydrographicDocument $hydrographicDocument;

    #[Validate('required')]
    public $subfile_id;

    #[Validate('required')]
    public $hydrographic_document_title;

    #[Validate('required')]
    public $hydrographic_document_filing_date;

    #[Validate('required')]
    public $document_type_id;

    #[Validate('required')]
    public $hydrographic_document_owner;

    #[Validate('required')]
    public $hydrographic_document_owner_status;

    #[Validate('required')]
    public $hydrographic_document_owner_type;

    // #[Validate('nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240')] //TODO: add this validation back in - currently it does not pass validation if the user edits a page that has an existing attachment and doesnt upload a new attachment. We need it to recognize and validate when an attachment already exists but has not been changed.
    #[Validate('nullable')]
    public $attachment_URL;

    public $attachment_file_path;

    public $is_deleted;

    public $created_at;

    public $created_by;

    public $updated_at;

    public $updated_by;

    public function setHydrographicDocument(HydrographicDocument $hydrographicDocument)
    {
        $userId = auth()->user()->id;

        $this->hydrographicDocument = $hydrographicDocument;

        $this->subfile_id = $hydrographicDocument->subfile_id;

        $this->hydrographic_document_title = $hydrographicDocument->hydrographic_document_title;

        $this->hydrographic_document_filing_date = $hydrographicDocument->hydrographic_document_filing_date;

        $this->attachment_URL = $hydrographicDocument->attachment_URL;
        $this->attachment_file_path = $hydrographicDocument->attachment_file_path;

        $this->document_type_id = $hydrographicDocument->document_type_id;

        $this->hydrographic_document_owner = $hydrographicDocument->hydrographic_document_owner;

        $this->hydrographic_document_owner_status = $hydrographicDocument->hydrographic_document_owner_status;
        $this->hydrographic_document_owner_type = $hydrographicDocument->hydrographic_document_owner_type;

        $this->created_at = $hydrographicDocument->created_at;
        $this->created_by = $userId;
        $this->updated_at = $hydrographicDocument->updated_at;
        $this->updated_by = $userId;
    }
}
