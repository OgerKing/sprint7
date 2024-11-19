<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\GlobalDocumentsForm;
use App\Models\Adjudication;
use App\Models\DocumentType;
use App\Models\GlobalDocument;
use App\Models\Person;
use App\Models\Pod;
use App\Models\Pou;
use App\Models\Subfile;
use App\Models\WaterRight;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class GlobalDocumentsFormHtml extends Component
{
    use WithFileUploads;

    public GlobalDocumentsForm $form;

    #[Url]
    public $adjudication_id = null; // Make optional by setting to null. Get from URL

    public array $selectedRows;

    public ?string $globalDocumentType = null; // prop set on mount. make optional by setting to null. Options: subfiles, ...

    public $adjudication;

    public $document;

    public $global_doc_id;

    public $date = '';

    public $documentCategoryOptions; //TODO: these dont exist in DB

    public $documentTypeOptions = [];

    public $editForm = false;

    public $hasAttachment = false;

    //disables inputs if false
    public $isEditable = false;

    protected $listeners = ['setGlobalDocumentId', 'resetDocumentsFields'];

    public function mount(?array $selectedRows = null, ?string $globalDocumentType = null)
    {
        if ($selectedRows) {
            $this->selectedRows = $selectedRows;
        }
        if ($globalDocumentType) {
            $this->globalDocumentType = $globalDocumentType;
        }

        if ($this->adjudication_id) {
            $this->getAdjudicationById();
        }

        $this->loadDocumentTypes();
        $this->loadDocumentCategoryOptions();
    }

    public function setGlobalDocumentId($global_doc_id)
    {
        $document = GlobalDocument::findOrFail($global_doc_id);
        $this->document = $document;

        $this->global_doc_id = $global_doc_id;
        $this->editForm = true;

        $this->form->setGlobalDocument($document);
        $this->hasAttachment = $this->form->attachment_URL;
    }

    public function getAdjudicationById()
    {
        $this->adjudication = Adjudication::findOrFail($this->adjudication_id);
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
        $this->documentCategoryOptions[] = [
            'label' => 'Global Document',
            'value' => 'Global Document',
        ];
    }

    public function cancel()
    {
        $this->resetDocumentsFields();
        $this->resetValidation();
        $this->dispatch('hide-global-docs-modal');
    }

    public function resetAttachmentURL()
    {

        $this->form->attachment_URL = $this->document->attachment_URL;
        $this->hasAttachment = $this->form->attachment_URL;
    }

    public function resetDocumentsFields()
    {
        $this->editForm = false;
        $this->global_doc_id = null;

        $this->form->global_document_title = null;
        $this->form->document_filing_date = null;
        $this->form->attachment_file_path = null;
        $this->form->attachment_URL = null;
        $this->form->global_document_type_id = '';
        $this->form->docket_id = null;
        $this->form->global_desc = null;
        $this->form->global_id_access = '1234567';
        $this->form->created_at = null;
        $this->form->created_by = null;
        $this->form->updated_at = null;
        $this->form->updated_by = null;

        $this->hideAllModals();

        $this->resetValidation();
    }

    //Points of Diversion
    public function getSelectedPointsOfDiversionProperty()
    {
        return Pod::find($this->selectedRows);
    }

    //Places of Use
    public function getSelectedPlacesOfUseProperty()
    {
        return Pou::find($this->selectedRows);
    }

    //WaterRights
    public function getSelectedWaterRightsProperty()
    {
        return WaterRight::find($this->selectedRows);
    }

    //Persons
    public function getSelectedPersonsProperty()
    {
        return Person::find($this->selectedRows);
    }

    // Subfiles
    public function getSelectedSubfilesProperty()
    {
        return Subfile::with('subfile_adjudication_status')->whereIn('id', $this->selectedRows)->get();
    }

    /**
     * Formats the Subfile ID.
     */
    public function formatSubfileID(Subfile $subfile): string
    {
        return strtoupper(
            "{$subfile->basin_section_hl}-{$subfile->sub_file_hl_txt}-{$subfile->sub_file_hl_sfx}"
        );
    }

    public function save()
    {
        $this->validate();

        $userId = auth()->user()->id;

        // Find and update the case
        $document = GlobalDocument::find($this->global_doc_id);

        $attachmentFileName = $document->attachment_file_path ?? null;
        $imagePreview = $document->attachment_URL ?? null;
        if ($document) {
            // Update existing document
            if ($this->form->attachment_URL && $this->form->attachment_URL !== $document->attachment_URL) {
                $attachmentFileName = $this->form->attachment_URL->getClientOriginalName();
                $imagePreview = $this->form->attachment_URL->storePublicly('document-management-global-documents');
            }

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
        } else {
            // Create a new document
            if ($this->form->attachment_URL) {
                $attachmentFileName = $this->form->attachment_URL->getClientOriginalName();
                $imagePreview = $this->form->attachment_URL->storePublicly('document-management-global-documents');
            }
            // Create a new document
            $document = GlobalDocument::create([
                'adjudication_id' => $this->adjudication_id ? $this->adjudication_id : null,
                'global_document_title' => $this->form->global_document_title,
                'global_document_type_id' => $this->form->global_document_type_id,
                'docket_id' => $this->form->docket_id,
                'global_desc' => $this->form->global_desc,
                'document_filing_date' => $this->form->document_filing_date,
                'attachment_file_path' => $this->form->attachment_file_path,
                'attachment_file_path' => $attachmentFileName,
                'attachment_URL' => $imagePreview,
                'global_id_access' => $this->form->global_id_access,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);

            session()->flash('success', 'Document created successfully');
        }

        if ($this->globalDocumentType === 'Subfiles') {
            // Add selected subfiles to the document with additional attributes
            $document->subfiles()->syncWithoutDetaching(
                collect($this->selectedRows)->mapWithKeys(function ($subfileId) {
                    $user = auth()->user(); // Get the currently authenticated use

                    return [
                        $subfileId => [
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => $user->id,  // Add created_by as the user's ID
                            'updated_by' => $user->id,
                        ],
                    ];
                })->toArray()
            );
        } elseif ($this->globalDocumentType === 'Persons') {
            // Add selected persons to the document with additional attributes
            $document->people()->syncWithoutDetaching(
                collect($this->selectedRows)->mapWithKeys(function ($personId) {
                    $user = auth()->user(); // Get the currently authenticated user

                    return [
                        $personId => [
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => $user->id,  // Add created_by as the user's ID
                            'updated_by' => $user->id,
                        ],
                    ];
                })->toArray()
            );
        } elseif ($this->globalDocumentType === 'Water Rights') {
            // Add selected water rights to the document with additional attributes
            $document->water_rights()->syncWithoutDetaching(
                collect($this->selectedRows)->mapWithKeys(function ($waterRightId) {
                    $user = auth()->user(); // Get the currently authenticated user

                    return [
                        $waterRightId => [
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => $user->id,  // Add created_by as the user's ID
                            'updated_by' => $user->id,
                        ],
                    ];
                })->toArray()
            );
        } elseif ($this->globalDocumentType === 'Places of Use') {
            // Add selected water rights to the document with additional attributes
            $document->places_of_use()->syncWithoutDetaching(
                collect($this->selectedRows)->mapWithKeys(function ($pouId) {
                    $user = auth()->user(); // Get the currently authenticated user

                    return [
                        $pouId => [
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => $user->id,  // Add created_by as the user's ID
                            'updated_by' => $user->id,
                        ],
                    ];
                })->toArray()
            );
        } elseif ($this->globalDocumentType === 'Points of Diversion') {
            // Add selected water rights to the document with additional attributes
            $document->points_of_diversion()->syncWithoutDetaching(
                collect($this->selectedRows)->mapWithKeys(function ($podId) {
                    $user = auth()->user(); // Get the currently authenticated user

                    return [
                        $podId => [
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => $user->id,  // Add created_by as the user's ID
                            'updated_by' => $user->id,
                        ],
                    ];
                })->toArray()
            );
        }

        $this->dispatch('refreshDocumentsList'); //refresh the table

        $this->dispatch('flashMessage', session('success'), 'success');
        $this->resetDocumentsFields();
        $this->resetValidation();
    }

    public function hideAllModals()
    {
        $this->dispatch('hide-global-docs-modal');
        $this->dispatch('hide-subfile-documents-modal');
        $this->dispatch('hide-persons-documents-modal');
        $this->dispatch('hide-water-rights-documents-modal');
        $this->dispatch('hide-places-of-use-documents-modal');
        $this->dispatch('hide-points-of-diversion-documents-modal');
    }

    public function render()
    {
        return view('livewire.components.global-documents-form-html');
    }
}
