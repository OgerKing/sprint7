<?php

namespace App\Livewire\Forms;

use App\Models\AdjudicationSection;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AdjudicationSectionForm extends Form
{
    public ?AdjudicationSection $adjudicationSection;

    #[Validate('required')]
    public $adjudication_id;

    public $water_source_id; //TODO: this doesnt exist in the form but is required in DB.

    public $created_by;

    public $updated_by;

    #[Validate('required')]
    public $adjudication_section_name = '';

    #[Validate('required')]
    public $prefix = '';

    #[Validate('required')]
    public $adjudication_section_status_id = '';

    #[Validate('required')]
    public $adjudication_section_type_id = '';

    #[Validate('required')]
    public $boundary_name = '';

    // #[Validate('required')]
    // public $boundary_type;

    public $adjudication_section_parent_id = ''; //Makes section into subsection(child)

    public function mount()
    {
        $userId = auth()->user()->id;
        $this->created_by = $userId;
        $this->updated_by = $userId;
    }

    public function setSection(AdjudicationSection $adjudicationSection)
    {
        $userId = auth()->user()->id;

        //If the section has a parent/is a child
        if ($adjudicationSection->parentSubsection) {
            $this->adjudication_section_parent_id = $adjudicationSection->parentSubsection->parent_adjudication_subsection_id;
        } else {
            $this->adjudication_section_parent_id = '';
        }
        $this->adjudicationSection = $adjudicationSection;

        $this->adjudication_id = $adjudicationSection->adjudication_id;
        $this->adjudication_section_name = $adjudicationSection->adjudication_section_name;
        $this->prefix = $adjudicationSection->prefix;
        $this->adjudication_section_status_id = $adjudicationSection->adjudication_section_status_id;
        $this->adjudication_section_type_id = $adjudicationSection->adjudication_section_type_id;
        $this->boundary_name = $adjudicationSection->boundary_name;
        // $this->boundary_type = $adjudicationSection->boundary_type;//removed from DB
        $this->water_source_id = $adjudicationSection->water_source_id;
        $this->created_by = $userId;
        $this->updated_by = $userId;
    }
}
