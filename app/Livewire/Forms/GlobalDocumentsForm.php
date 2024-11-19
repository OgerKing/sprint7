<?php

namespace App\Livewire\Forms;

use App\Models\GlobalDocument;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class GlobalDocumentsForm extends Form
{
    use WithFileUploads;

    public ?GlobalDocument $globalDocument;

    #[Validate('required')]
    public $global_document_title;

    #[Validate('required')]
    public $document_filing_date;

    #[Validate('nullable')]
    public $attachment_file_path;

    // #[Validate('nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240')] //TODO: add this validation back in - currently it does not pass validation if the user edits a page that has an existing attachment and doesnt upload a new attachment. We need it to recognize and validate when an attachment already exists but has not been changed.
    #[Validate('nullable')]
    public $attachment_URL;

    #[Validate('required')]
    public $global_document_type_id = '';

    #[Validate('required', 'max:10')]
    public $docket_id;

    #[Validate('required')]
    public $global_desc;

    public $adjudication_id;

    public $global_id_access = '122345'; //TODO: not in designs or specs

    public $created_at;

    public $created_by;

    public $updated_at;

    public $updated_by;

    public $global_document_category = 'Global Documents'; //TODO: this does not exist in table

    public function setGlobalDocument(GlobalDocument $globalDocument)
    {
        $userId = auth()->user()->id;

        $this->globalDocument = $globalDocument;

        $this->adjudication_id = $globalDocument->adjudication_id;
        $this->global_document_title = $globalDocument->global_document_title;
        $this->document_filing_date = $globalDocument->document_filing_date;
        $this->attachment_file_path = $globalDocument->attachment_file_path;
        $this->attachment_URL = $globalDocument->attachment_URL;
        $this->global_document_type_id = $globalDocument->global_document_type_id;
        $this->docket_id = $globalDocument->docket_id;
        $this->global_desc = $globalDocument->global_desc;
        $this->global_id_access = $globalDocument->global_id_access;
        $this->created_at = $globalDocument->created_at;
        $this->created_by = $userId;
        $this->updated_at = $globalDocument->updated_at;
        $this->updated_by = $userId;
    }
}
