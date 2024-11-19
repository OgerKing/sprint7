<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\AddOrEditAdjudicationForm;
use App\Models\Adjudication;
use App\Models\AdjudicationStatus;
use App\Models\Bureau;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class AdjudicationEditSidebar extends Component
{
    public AddOrEditAdjudicationForm $form;

    public $adjudication;

    //dropdown options
    public $bureauOptions = [];

    public $statusOptions = [];

    public $mapping_zone_west;

    public $mapping_zone_central;

    public $mapping_zone_east;

    public $mapping_zones = null;

    //adjudication id to edit
    public $adjudicationId;

    //disables inputs if false
    public $isEditable = false;

    public $isOpen = false; //is sidebar background open

    protected $listeners = ['editAdjudication'];

    public function mount()
    {
        //load dropdown options
        $this->loadBureaus();
        $this->loadStatuses();

        //get logged in user
        $userId = auth()->user()->id;

        //set the form fields to user id
        $this->form->created_by = $userId;
        $this->form->updated_by = $userId;
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

    // Listen for editAdjudication, grab the adjudicationId and load it.
    public function editAdjudication($adjudicationId)
    {
        try {
            $this->adjudicationId = $adjudicationId;
            $this->loadAdjudication(); //prefill the form with existing data
            $this->isOpen = true;
        } catch (ModelNotFoundException $e) {
            session()->flash('status', 'Adjudication not found.');
            session()->flash('status_type', 'error');
            $this->dispatch('flashMessage', session('status'), session('status_type'));
        } catch (Exception $e) {
            session()->flash('status', 'An error occurred: '.$e->getMessage());
            session()->flash('status_type', 'error');
            $this->dispatch('flashMessage', session('status'), session('status_type'));
        }
    }

    // Load the single adjudication by id.
    public function loadAdjudication()
    {
        try {
            $adjudication = Adjudication::findOrFail($this->adjudicationId);
            $this->adjudication = $adjudication;
            $this->form->setAdjudicationForm($adjudication);
            $this->form->mapping_zone_west = (bool) $adjudication->mapping_zone_west;
            $this->form->mapping_zone_central = (bool) $adjudication->mapping_zone_central;
            $this->form->mapping_zone_east = (bool) $adjudication->mapping_zone_east;
        } catch (ModelNotFoundException $e) {
            session()->flash('status', 'Adjudication not found.');
            session()->flash('status_type', 'error');
            $this->dispatch('flashMessage', session('status'), session('status_type'));
        } catch (Exception $e) {
            session()->flash('status', 'An error occurred while loading the adjudication: '.$e->getMessage());
            session()->flash('status_type', 'error');
            $this->dispatch('flashMessage', session('status'), session('status_type'));
        }
    }

    public function toggleEdit()
    {
        $this->isEditable = ! $this->isEditable;
    }

    // Submit edit form.
    public function submit()
    {
        $this->mapping_zones = $this->form->mapping_zone_west || $this->form->mapping_zone_east || $this->form->mapping_zone_central ? 1 : null;

        // Validate the form inputs
        $this->validate(
            [
                'form.adjudication_name' => 'required',
                'form.prefix' => 'required|string|max:10',
                'form.adjudication_nickname' => 'required',
                'form.adjudication_status_id' => 'required',
                'form.bureau_id' => 'required',
                'form.mapping_zone_west' => 'boolean',
                'form.mapping_zone_central' => 'boolean',
                'form.mapping_zone_east' => 'boolean',
                'mapping_zones' => 'required', // Ensure at least one is checked
            ],
            [
                'mapping_zones.required' => 'Please select at least one Mapping Zone.',
            ],
        );

        $userId = auth()->user()->id;
        $adjudication = Adjudication::findOrFail($this->adjudicationId);

        $data = [
            'adjudication_name' => $this->form->adjudication_name,
            'prefix' => $this->form->prefix,
            'adjudication_nickname' => $this->form->adjudication_nickname,
            'adjudication_status_id' => $this->form->adjudication_status_id,
            'bureau_id' => $this->form->bureau_id,
            'adjudication_boundary_map_link' => $this->form->adjudication_boundary_map_link,
            'updated_by' => $userId,

            'mapping_zone_central' => $this->form->mapping_zone_central,
            'mapping_zone_east' => $this->form->mapping_zone_east,
            'mapping_zone_west' => $this->form->mapping_zone_west,
        ];

        $adjudication->update($data);

        //show success message
        session()->flash('success', 'Adjudication successfully updated.');
        $this->dispatch('flashMessage', session('success'), 'success');

        $this->isEditable = false; //disable inputs after submission
        $this->dispatch('refreshComponent'); //refresh the adjudication cards.

    }

    public function setEditableAndResetForm()
    {
        $this->isEditable = false;
        $this->resetEditAdjudicationFields();
    }

    public function resetEditAdjudicationFields()
    {
        $this->form->setAdjudicationForm($this->adjudication);

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.components.adjudication-edit-sidebar');
    }
}
