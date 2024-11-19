<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\GlobalDocumentsForm;
use App\Models\DocumentType;
use App\Models\GlobalDocument;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentManagementGlobalForm extends Component
{
    use WithFileUploads;

    public GlobalDocumentsForm $form;

    #[Url]
    public $document_id;

    public $document;

    public $documentCategoryOptions; //TODO: these dont exist in DB

    public $documentTypeOptions = [];

    public $hasAttachment = false;

    //disables inputs if false
    public $isEditable = false;

    protected $listeners = ['setGlobalDocumentId',  'editGlobalDocument' => 'setGlobalDocumentId'];

    public function mount($document_id)
    {
        $this->document_id = $document_id;

        if ($this->document_id) {
            $this->setGlobalDocumentId($this->document_id);
        }

        $this->loadDocumentTypes();
        $this->loadDocumentCategoryOptions();
    }

    public function setGlobalDocumentId($document_id)
    {
        $document = GlobalDocument::with('adjudication', 'subfiles', 'people', 'water_rights', 'global_document_p_o_ds', 'global_document_p_o_us')->findOrFail($document_id);
        // Fetch the document using the ID
        $this->document = $document;

        // Populate the form fields with the document data
        $this->form->global_document_title = $document->global_document_title;
        $this->form->global_document_type_id = $document->global_document_type_id;
        $this->form->docket_id = $document->docket_id;
        $this->form->global_desc = $document->global_desc;
        $this->form->document_filing_date = $document->document_filing_date;
        $this->form->attachment_URL = $document->attachment_URL;
        $this->form->attachment_file_path = $document->attachment_file_path;
        $this->form->global_id_access = $document->global_id_access;

        $this->hasAttachment = $this->form->attachment_URL;
    }

    public function resetAttachmentURL()
    {
        $this->form->attachment_URL = $this->document->attachment_URL;
        $this->hasAttachment = $this->form->attachment_URL;
    }

    public function loadDocumentTypes()
    {
        //Get only the global document type
        $documentType = DocumentType::where('document_type_description', 'Global Document')
            ->first();

        $documentTypeOptions = [];

        if ($documentType) {
            $documentTypeOptions[] = [
                'label' => $documentType->document_type_description,
                'value' => $documentType->id,
            ];
        }

        $this->documentTypeOptions = $documentTypeOptions;
    }

    public function loadDocumentCategoryOptions()
    {
        //TODO: can we pull these from the DB?
        $this->documentCategoryOptions[] = [
            'label' => 'Global Document',
            'value' => 'Global Document',
        ];
    }

    public function save()
    {
        $this->validate();
        $userId = auth()->user()->id;

        $imagePreview = $this->document->attachment_URL; // Set the current file path if it exists
        $attachmentFileName = $this->document->attachment_file_path;
        if ($this->form->attachment_URL !== $this->document->attachment_URL) {
            $attachmentFileName = $this->form->attachment_URL->getClientOriginalName();
            $imagePreview = $this->form->attachment_URL->storePublicly('document-management-global-documents');
        }

        // Find the global document
        $document = GlobalDocument::findOrFail($this->document_id);

        if ($document) {
            //update the document
            $document->update([
                'global_document_title' => $this->form->global_document_title,
                'global_document_type_id' => $this->form->global_document_type_id,
                'docket_id' => $this->form->docket_id,
                'global_desc' => $this->form->global_desc,
                'document_filing_date' => $this->form->document_filing_date,
                'attachment_file_path' => $attachmentFileName,
                'attachment_URL' => $imagePreview ?? $document->attachment_URL,
                'updated_by' => $userId,
            ]);

            session()->flash('success', 'Document updated successfully');
        }
        // Refresh the form with updated data
        $this->setGlobalDocumentId($this->document_id);
        $this->isEditable = false; //disable inputs after submission

        $this->dispatch('flashMessage', session('success'), 'success');
    }

    public function cancel()
    {
        $this->setGlobalDocumentId($this->document_id);
        $this->isEditable = false;
        $this->resetValidation();
    }

    public function toggleEdit()
    {
        $this->isEditable = ! $this->isEditable;
    }

    public function render()
    {
        return view('livewire.components.document-management-global-form');
    }
}
