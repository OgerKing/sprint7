<?php

namespace App\Livewire\Forms;

use App\Models\DefendantDocument;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class DefendantDocumentsForm extends Form
{
    use WithFileUploads;

    public ?DefendantDocument $defendantDocument;

    #[Validate('required')]
    public $document_title;

    #[Validate('required')]
    public $document_type_id;

    #[Validate('required')]
    public $docket_id;

    #[Validate('nullable')]
    public $attachment_file_path;

    // #[Validate('nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240')] //TODO: add this validation back in - currently it does not pass validation if the user edits a page that has an existing attachment and doesnt upload a new attachment. We need it to recognize and validate when an attachment already exists but has not been changed.
    #[Validate('nullable')]
    public $attachment_URL;

    #[Validate('required')]
    public $document_filing_date;

    #[Validate('required')]
    public $subfile_id;

    public $defendant;

    public $person_id;

    public $created_at;

    public $created_by;

    public $updated_at;

    public $updated_by;

    public function setDefendantDocument(DefendantDocument $defendantDocument)
    {
        $userId = auth()->user()->id;

        $this->defendantDocument = $defendantDocument;

        $this->document_title = $defendantDocument->document_title;
        $this->subfile_id = $defendantDocument->subfile_id;
        $this->person_id = $defendantDocument->person_id;
        $this->document_filing_date = $defendantDocument->document_filing_date;
        $this->attachment_URL = $defendantDocument->attachment_URL;
        $this->document_type_id = $defendantDocument->document_type_id;
        $this->defendant = $defendantDocument->defendant;
        $this->docket_id = $defendantDocument->docket_id;
        $this->created_at = $defendantDocument->created_at;
        $this->created_by = $userId;
        $this->updated_at = $defendantDocument->updated_at;
        $this->updated_by = $userId;
        $this->attachment_file_path = $defendantDocument->attachment_file_path;
    }
}
