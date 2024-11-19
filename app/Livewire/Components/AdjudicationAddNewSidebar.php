<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\AddOrEditAdjudicationForm;
use App\Models\Adjudication;
use App\Models\AdjudicationStatus;
use App\Models\Bureau;
use Livewire\Component;

class AdjudicationAddNewSidebar extends Component
{
    public AddOrEditAdjudicationForm $form;

    public $bureauOptions = [];

    public $statusOptions = [];

    public ?bool $mapping_zone_west = false;

    public ?bool $mapping_zone_central = false;

    public ?bool $mapping_zone_east = false;

    public $mapping_zones = null;

    public $isOpen = true; //is sidebar open

    public $submissionSuccess = false; //show flash message on true

    protected $listeners = ['resetAddAdjudicationFields'];

    public function mount()
    {
        //load dropdown options
        $this->loadBureaus();
        $this->loadStatuses();
        //get user id for logged in user
        $userId = auth()->user()->id;
        //set the form's createdby and updated_by columns.
        $this->form->created_by = $userId;
        $this->form->updated_by = $userId;

        $this->resetAddAdjudicationFields();
    }

    public function loadBureaus()
    {
        $bureaus = Bureau::get();

        foreach ($bureaus as $bureau) {
            $bureauOptions[] = [
                'label' => $bureau->bureau_name,
                'value' => $bureau->id,
            ];
        }
        $this->bureauOptions = $bureauOptions;
    }

    public function loadStatuses()
    {
        $statuses = AdjudicationStatus::get();

        foreach ($statuses as $status) {
            $statusOptions[] = [
                'label' => $status->adjudication_status_description,
                'value' => $status->id,
            ];
        }
        $this->statusOptions = $statusOptions;
    }

    public function submit()
    {
        // Set mapping_zones based on the selected zones
        $this->mapping_zones = $this->form->mapping_zone_west || $this->form->mapping_zone_east || $this->form->mapping_zone_central ? 1 : null;
        // Validate the form inputs
        $this->validate(
            [
                'form.adjudication_name' => 'required',
                'form.prefix' => 'required|string|max:10',
                'form.adjudication_nickname' => 'required',
                'form.adjudication_status_id' => 'required',
                'form.bureau_id' => 'required',
                'mapping_zones' => 'required', // Ensure at least one is checked
            ],
            [
                'mapping_zones.required' => 'Please select at least one Mapping Zone.',
            ],
        );

        $userId = auth()->user()->id;
        $data = [
            'adjudication_name' => $this->form->adjudication_name,
            'prefix' => $this->form->prefix,
            'adjudication_nickname' => $this->form->adjudication_nickname,
            'adjudication_status_id' => $this->form->adjudication_status_id,
            'adjudication_district_id' => $this->form->adjudication_district_id,
            'bureau_id' => $this->form->bureau_id,
            'coordinate_system' => $this->form->coordinate_system,
            'adjudication_boundary_map_link' => $this->form->adjudication_boundary_map_link,
            'created_by' => $userId,
            'updated_by' => $userId,
            'hydrographic_survey_description' => $this->form->hydrographic_survey_description,
            'mapping_zone_central' => $this->form->mapping_zone_central ? 1 : 0,
            'mapping_zone_east' => $this->form->mapping_zone_east ? 1 : 0,
            'mapping_zone_west' => $this->form->mapping_zone_west ? 1 : 0,
        ];

        Adjudication::create($data);

        session()->flash('success', 'Adjudication successfully created.');
        $this->submissionSuccess = true; // Mark as successful to display flash message

        $this->isOpen = false;

        //refresh the adjudication cards
        $this->dispatch('refreshComponent');
    }

    public function resetAddAdjudicationFields()
    {
        $this->form->adjudication_section_name = '';
        $this->form->prefix = '';
        $this->form->adjudication_section_status_id = '';
        $this->form->adjudication_section_type_id = '';
        $this->form->boundary_name = '';
        $this->form->boundary_type = '';

        $this->form->adjudication_name = '';
        $this->form->prefix = '';
        $this->form->adjudication_nickname = '';
        $this->form->adjudication_status_id = '';
        // $this->form->adjudication_district_id = '';
        $this->form->bureau_id = '';
        // $this->form->coordinate_system = '';
        $this->form->adjudication_boundary_map_link = '';
        // $this->form->hydrographic_survey_description = '';

        $this->form->mapping_zone_west = null;
        $this->form->mapping_zone_central = null;
        $this->form->mapping_zone_east = null;
        $this->form->mapping_zones = '';

        $this->resetValidation();
        $this->submissionSuccess = false;
    }

    public function render()
    {
        return view('livewire.components.adjudication-add-new-sidebar');
    }
}
