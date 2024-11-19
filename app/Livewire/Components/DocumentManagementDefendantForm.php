<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\DefendantDocumentsForm;
use App\Models\DefendantDocument;
use App\Models\DocumentType;
use App\Models\Subfile;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentManagementDefendantForm extends Component
{
    use WithFileUploads;

    public DefendantDocumentsForm $form;

    #[Url]
    public $document_id;

    public $document;

    public $documentTypeOptions = [];

    public $subfileOptions = [];

    //disables inputs if false
    public $isEditable = false;

    public $hasAttachment = false;

    protected $listeners = ['setDefendantDocumentId',  'editDefendantDocument' => 'setDefendantDocumentId'];

    public function mount($document_id)
    {
        $this->document_id = $document_id;

        if ($this->document_id) {
            $this->setDefendantDocumentId($this->document_id);
        }

        $this->loadDocumentTypes();
        $this->loadSubfileOptions();
    }

    public function setDefendantDocumentId($document_id)
    {
        $document = DefendantDocument::findOrFail($document_id);  // Fetch the document using the ID

        $this->document = $document;

        // Populate the form fields with the document data
        $this->form->document_title = $document->document_title;
        $this->form->person_id = $document->person_id;
        $this->form->document_filing_date = $document->document_filing_date;
        $this->form->attachment_URL = $document->attachment_URL;
        $this->form->document_type_id = $document->document_type_id;
        $this->form->defendant = $document->defendant;
        $this->form->docket_id = $document->docket_id;
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
            $imagePreview = $this->form->attachment_URL->storePublicly('defendant-documents');
        }

        // Find the global document
        $document = DefendantDocument::find($this->document_id);

        if ($document) {

            //update the document
            $document->update([
                'document_title' => $this->form->document_title,
                'document_type_id' => $this->form->document_type_id,
                'docket_id' => $this->form->docket_id,
                'attachment_file_path' => $attachmentFileName,
                'document_filing_date' => $this->form->document_filing_date,
                'attachment_URL' => $imagePreview ?? $document->attachment_URL,
                'subfile_id' => $this->form->subfile_id,
                'updated_by' => $userId,
            ]);

            session()->flash('success', 'Document updated successfully');
        }
        // Refresh the form with updated data
        $this->setDefendantDocumentId($this->document_id);
        $this->isEditable = false; //disable inputs after submission

        $this->dispatch('flashMessage', session('success'), 'success');
    }

    public function cancel()
    {
        $this->setDefendantDocumentId($this->document_id);
        $this->isEditable = false;
        $this->resetValidation();
    }

    public function toggleEdit()
    {
        $this->isEditable = ! $this->isEditable;
    }

    public function render()
    {
        return view('livewire.components.document-management-defendant-form');
    }
}
