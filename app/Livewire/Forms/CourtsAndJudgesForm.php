<?php

namespace App\Livewire\Forms;

use App\Models\CourtCase;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class CourtsAndJudgesForm extends Form
{
    use WithFileUploads;

    public ?CourtCase $courtCase;

    #[Validate('required')]
    public $court_type;

    #[Validate('required')]
    public $court_id;

    public $court_name; //THIS IS DISTRICT. court name aka district.

    #[Validate('required')]
    public $court_judge_id; //DISTRICT JUDGE

    public $court_master_id; //For FEDERAL

    #[Validate('required')]
    public $adjudication_sections = [];

    #[Validate('required')]
    public $case_name;

    #[Validate('required')]
    public $case_number;

    #[Validate('required')]
    public $court_docket_link;

    public $created_by;

    public $updated_by;

    #[Validate('image|nullable')]
    public $court_judge_signature;

    #[Validate('image|nullable')]
    public $court_master_signature;

    //TODO: need to add a new record to the audit trail table on submit
    //TODO: delete functionality.
    public function setCourtCase(CourtCase $courtCase)
    {
        $userId = auth()->user()->id;

        $this->courtCase = $courtCase;

        $this->court_type = $courtCase->court->court_type;
        $this->court_id = $courtCase->court->id; //using this for district court_name;
        $this->court_name = $courtCase->court->court_name;
        $this->court_judge_id = $courtCase->court_judge_id;
        $this->court_master_id = $courtCase->court_master_id;
        $this->adjudication_sections = $courtCase->adjudication_sections;
        $this->case_name = $courtCase->case_name;
        $this->case_number = $courtCase->case_number;
        $this->court_docket_link = $courtCase->court_docket_link;
        $this->created_by = $userId;
        $this->updated_by = $userId;
    }
}
