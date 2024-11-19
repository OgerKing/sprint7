<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\AdjudicationSectionForm;
use App\Models\AdjudicationSection;
use App\Models\AdjudicationSectionStatus;
use App\Models\AdjudicationSectionType;
use App\Models\AdjudicationSubsection;
use App\Models\WaterSource;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class UpdateSectionForm extends Component
{
    public AdjudicationSectionForm $form;

    #[Url]
    public $adjudication_id; //get from url

    public $sectionId; //selected section to update

    public $safeSubsectionParentList = []; //options for selecting a section parent

    public $adjudicationStatusList = []; //status options

    public $adjudicationSectionTypesList = []; //section type options

    public $boundaryTypeOptions = [];

    public $isParent = false; //true if section has subsections

    public $isChild = false; //true if section is a child of a section

    public $showParentDropdown = true; //show if is not Parent.

    protected $listeners = ['setEditSectionId', 'resetFields'];

    public function mount()
    {
        $userId = auth()->user()->id;

        //load dropdown options
        $this->safeSubsectionParentList = $this->getSafeSubsectionParentList();
        $this->adjudicationStatusList = $this->getFormattedStatusList();
        $this->adjudicationSectionTypesList = $this->getFormattedSectionTypesList();
        // $this->boundaryTypeOptions = $this->getBoundaryTypeOptions();

        //set form inputs for associated adjudication_id
        $this->form->adjudication_id = $this->adjudication_id;
        $this->form->created_by = $userId;
        $this->form->updated_by = $userId;
    }

    public function checkIfChild($sectionId)
    {
        $section = AdjudicationSection::find($sectionId);

        $this->isParent = $section->isParent();
        $this->isChild = $section->isChild();

        //show the parent dropdown if the section is not a parent.
        $this->showParentDropdown = ! $this->isParent;
    }

    public function setEditSectionId($section_id)
    {
        $section = AdjudicationSection::find($section_id);
        $this->sectionId = $section->id;
        $this->checkIfChild($this->sectionId);

        $this->form->setSection($section); //load form inputs with data
    }

    public function save()
    {
        $this->validate();

        //get form data
        $sectionData = $this->form->toArray();
        //get $sectionId if section already exists
        $sectionId = $this->sectionId;

        //get parent ID from the form if available
        $parentId = $this->form->adjudication_section_parent_id ?? null;

        //determine if create or update. if there is a $sectionId, it's an update.
        if ($sectionId) {
            // Update the section
            $section = AdjudicationSection::findOrFail($sectionId);
            $section->update($sectionData);
        } else {
            // Create a new section
            $section = AdjudicationSection::create($sectionData);
        }

        //update the selected section to be the child of the $parentId. If no parent is provided, it wont create a row in Adjudication Subsections, and will delete any existing association rows.
        $section->associateWithParent($parentId, Auth::user()->name);

        //set flash alert
        if ($section->wasRecentlyCreated) {
            session()->flash('success', 'Adjudication Section successfully created.');
        } else {
            session()->flash('success', 'Adjudication Section successfully updated.');
        }

        $this->dispatch('flashMessage', session('success'), 'success');
        $this->dispatch('hide-sections-modal'); // Emit event to close the modal
        $this->dispatch('refreshSectionsList'); //refresh the table
        $this->dispatch('resetFields'); //reset the form
    }

    public function getSafeSubsectionParentList()
    {
        $adjudicationSubsection = new AdjudicationSubsection;
        $safeList = $adjudicationSubsection->safe_subsection_parent_list($this->adjudication_id);
        $safeListArray = json_decode($safeList, true);

        return array_map(function ($item) {
            return [
                'value' => $item['id'],
                'label' => $item['adjudication_section_name'],
            ];
        }, $safeListArray);
    }

    public function getFormattedStatusList()
    {
        $statuses = AdjudicationSectionStatus::all();

        return $statuses->map(function ($status) {
            return [
                'value' => $status->id,
                'label' => $status->adjudication_section_status_description,
            ];
        })->toArray();
    }

    public function getFormattedSectionTypesList()
    {
        $types = AdjudicationSectionType::all();

        return $types->map(function ($type) {
            return [
                'value' => $type->id,
                'label' => $type->adjudication_section_type_code,
            ];
        })->toArray();
    }

    public function getBoundaryTypeOptions()
    {
        $boundary_types = WaterSource::all();

        return $boundary_types->map(function ($type) {
            return [
                'value' => $type->id,
                'label' => $type->water_source_description,
            ];
        })->toArray();
    }

    public function resetFields()
    {
        //reset checks on if section is parent/child
        $this->isParent = false;
        $this->isChild = false;
        $this->showParentDropdown = true;
        $this->sectionId = null;

        $this->form->adjudication_section_name = '';
        $this->form->prefix = '';
        $this->form->adjudication_section_status_id = '';
        $this->form->adjudication_section_type_id = '';
        $this->form->boundary_name = '';
        // $this->form->boundary_type = '';

        //reset parent section id to null. reload safeSubsectionParentList
        $this->form->adjudication_section_parent_id = null;
        $this->safeSubsectionParentList = $this->getSafeSubsectionParentList();

        $this->resetValidation();
        $this->dispatch('hide-sections-modal');
    }

    public function render()
    {
        return view('livewire.components.update-section-form');
    }
}
