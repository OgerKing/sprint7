<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\AdjudicationDocumentsForm;
use App\Models\AdjudicationDocument;
use App\Models\DocumentType;
use App\Models\Subfile;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentManagementAdjudicationForm extends Component
{
    use WithFileUploads;

    public AdjudicationDocumentsForm $form;

    #[Url]
    public $document_id;

    public $document;

    public $documentTypeOptions = [];

    public $subfileOptions = [];

    //disables inputs if false
    public $isEditable = false;

    public $hasAttachment = false;

    protected $listeners = ['setAdjudicationDocumentId',  'editAdjudicationDocument' => 'setAdjudicationDocumentId'];

    public function mount($document_id)
    {
        $this->document_id = $document_id;

        if ($this->document_id) {
            $this->setAdjudicationDocumentId($this->document_id);
        }

        $this->loadDocumentTypes();
        $this->loadSubfileOptions();
    }

    public function setAdjudicationDocumentId($document_id)
    {
        $document = AdjudicationDocument::findOrFail($document_id);  // Fetch the document using the ID
        $this->document = $document;

        // Populate the form fields with the document data
        $this->form->subfile_id = $document->subfile_id;
        $this->form->document_filing_date = $document->document_filing_date;
        $this->form->attachment_URL = $document->attachment_URL;
        $this->form->attachment_file_path = $document->attachment_file_path;
        $this->form->adjudication_document_code = $document->adjudication_document_code;
        $this->form->adjudication_document_title = $document->adjudication_document_title;
        $this->form->document_type_id = $document->document_type_id;

        $this->form->created_at = $document->created_at;
        $this->form->created_by = $document->created_by;
        $this->form->updated_at = $document->updated_at;
        $this->form->updated_by = $document->updated_by;
        $this->hasAttachment = $this->form->attachment_URL;
    }

    public function resetAttachmentURL()
    {

        $this->form->attachment_URL = $this->document->attachment_URL;
        $this->hasAttachment = $this->form->attachment_URL;
    }

    public function loadDocumentTypes()
    {
        $documentTypes = DocumentType::get();
        $documentTypeOptions = [];
        foreach ($documentTypes as $type) {
            $documentTypeOptions[] = [
                'label' => $type->document_type_description,
                'value' => $type->id,
            ];
        }
        $this->documentTypeOptions = $documentTypeOptions;
    }

    public function loadSubfileOptions()
    {
        $subfiles = Subfile::get();
        $subfileOptions = [];

        foreach ($subfiles as $subfile) {
            $subfileOptions[] = [
                'label' => $subfile->get_appropriate_file_name($subfile->id),
                'value' => $subfile->id,
            ];
        }
        $this->subfileOptions = $subfileOptions;
    }

    public function save()
    {
        $this->validate();

        $userId = auth()->user()->id;

        $imagePreview = $this->document->attachment_URL; // Set the current file path if it exists
        $attachmentFileName = $this->document->attachment_file_path;
        if ($this->form->attachment_URL !== $this->document->attachment_URL) {
            $attachmentFileName = $this->form->attachment_URL->getClientOriginalName();
            $imagePreview = $this->form->attachment_URL->storePublicly('adjudication-documents');
        }

        // Find the adjudication document
        $document = AdjudicationDocument::findOrFail($this->document_id);

        if ($document) {

            //update the document
            $document->update([
                'subfile_id' => $this->form->subfile_id,
                'adjudication_document_code' => $this->form->adjudication_document_code,
                'adjudication_document_title' => $this->form->adjudication_document_title,
                'document_type_id' => $this->form->document_type_id,
                'document_filing_date' => $this->form->document_filing_date,
                'attachment_URL' => $imagePreview ?? $document->attachment_URL,
                'attachment_file_path' => $attachmentFileName,

                'updated_by' => $userId,
            ]);

            session()->flash('success', 'Document updated successfully');
        }
        // Refresh the form with updated data
        $this->setAdjudicationDocumentId($this->document_id);
        $this->isEditable = false; //disable inputs after submission

        $this->dispatch('flashMessage', session('success'), 'success');
    }

    public function cancel()
    {
        $this->setAdjudicationDocumentId($this->document_id);
        $this->isEditable = false;
        $this->resetValidation();
    }

    public function toggleEdit()
    {
        $this->isEditable = ! $this->isEditable;
    }

    public function render()
    {
        return view('livewire.components.document-management-adjudication-form');
    }
}
