<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\HydrographicDocumentsForm;
use App\Models\DocumentType;
use App\Models\HydrographicDocument;
use App\Models\Subfile;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentManagementHydrographicForm extends Component
{
    use WithFileUploads;

    public HydrographicDocumentsForm $form;

    #[Url]
    public $document_id;

    public $document;

    public $documentTypeOptions = [];

    public $subfileOptions = [];

    //disables inputs if false
    public $isEditable = false;

    public $hasAttachment = false;

    protected $listeners = ['setHydrographicDocumentId',  'editHydrographicDocument' => 'setHydrographicDocumentId'];

    public function mount($document_id)
    {
        $this->document_id = $document_id;

        if ($this->document_id) {
            $this->setHydrographicDocumentId($this->document_id);
        }

        $this->loadDocumentTypes();
        $this->loadSubfileOptions();
    }

    public function setHydrographicDocumentId($document_id)
    {
        $document = HydrographicDocument::findOrFail($document_id);  // Fetch the document using the ID
        $this->document = $document;

        // Populate the form fields with the document data
        $this->form->hydrographic_document_title = $document->hydrographic_document_title;
        $this->form->hydrographic_document_filing_date = $document->hydrographic_document_filing_date;
        $this->form->attachment_URL = $document->attachment_URL;
        $this->form->document_type_id = $document->document_type_id;
        $this->form->hydrographic_document_owner = $document->hydrographic_document_owner;
        $this->form->hydrographic_document_owner_status = $document->hydrographic_document_owner_status;
        $this->form->hydrographic_document_owner_type = $document->hydrographic_document_owner_type;
        $this->form->created_at = $document->created_at;
        $this->form->created_by = $document->created_by;
        $this->form->updated_at = $document->updated_at;
        $this->form->updated_by = $document->updated_by;
        $this->form->attachment_file_path = $document->attachment_file_path;
        $this->form->subfile_id = $document->subfile_id;

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
            $imagePreview = $this->form->attachment_URL->storePublicly('hydrographic-documents');
        }

        // Find the global document
        $document = HydrographicDocument::find($this->document_id);

        if ($document) {

            //update the document
            $document->update([
                'document_title' => $this->form->hydrographic_document_title,
                'document_type_id' => $this->form->document_type_id,
                'hydrographic_document_owner' => $this->form->hydrographic_document_owner,
                'hydrographic_document_owner_status' => $this->form->hydrographic_document_owner_status,
                'hydrographic_document_owner_type' => $this->form->hydrographic_document_owner_type,
                'attachment_file_path' => $attachmentFileName,
                'hydrographic_document_filing_date' => $this->form->hydrographic_document_filing_date,
                'attachment_URL' => $imagePreview ?? $document->attachment_URL,
                'subfile_id' => $this->form->subfile_id,
                'updated_by' => $userId,
            ]);

            session()->flash('success', 'Document updated successfully');
        }
        // Refresh the form with updated data
        $this->setHydrographicDocumentId($this->document_id);
        $this->isEditable = false; //disable inputs after submission

        $this->dispatch('flashMessage', session('success'), 'success');
    }

    public function cancel()
    {
        $this->setHydrographicDocumentId($this->document_id);
        $this->isEditable = false;
        $this->resetValidation();
    }

    public function toggleEdit()
    {
        $this->isEditable = ! $this->isEditable;
    }

    public function render()
    {
        return view('livewire.components.document-management-hydrographic-form');
    }
}
