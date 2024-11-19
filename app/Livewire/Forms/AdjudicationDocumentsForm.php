<?php

namespace App\Livewire\Forms;

use App\Models\AdjudicationDocument;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class AdjudicationDocumentsForm extends Form
{
    use WithFileUploads;

    public ?AdjudicationDocument $adjudicationDocument;

    #[Validate('required')]
    public $subfile_id;

    #[Validate('required')]
    public $adjudication_document_code;

    #[Validate('required')]
    public $adjudication_document_title;

    #[Validate('required')]
    public $document_type_id;

    #[Validate('required')]
    public $document_filing_date;

    #[Validate('nullable')]
    public $attachment_file_path;

    // #[Validate('nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240')] //TODO: add this validation back in - currently it does not pass validation if the user edits a page that has an existing attachment and doesnt upload a new attachment. We need it to recognize and validate when an attachment already exists but has not been changed. Try using mimetypes instead of mimes
    #[Validate('nullable')]
    public $attachment_URL;

    public $is_deleted;

    public $created_at;

    public $created_by;

    public $updated_at;

    public $updated_by;

    public $deleted_at;

    public function setAdjudicationDocument(AdjudicationDocument $adjudicationDocument)
    {
        $userId = auth()->user()->id;

        $this->adjudicationDocument = $adjudicationDocument;

        $this->subfile_id = $adjudicationDocument->subfile_id;
        $this->adjudication_document_code = $adjudicationDocument->adjudication_document_code;
        $this->adjudication_document_title = $adjudicationDocument->adjudication_document_title;
        $this->document_type_id = $adjudicationDocument->document_type_id;
        $this->document_filing_date = $adjudicationDocument->document_filing_date;
        $this->attachment_URL = $adjudicationDocument->attachment_URL;
        $this->attachment_file_path = $adjudicationDocument->attachment_file_path;

        $this->is_deleted = $adjudicationDocument->is_deleted;
        $this->created_at = $adjudicationDocument->created_at;
        $this->created_by = $userId;
        $this->updated_at = $adjudicationDocument->updated_at;
        $this->updated_by = $userId;
        $this->deleted_at = $adjudicationDocument->deleted_at;
    }
}
