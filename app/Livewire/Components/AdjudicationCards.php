<?php

namespace App\Livewire\Components;

use App\Models\AdjudicationSection;
use App\Models\CourtCase;
use App\Models\CourtCaseAdjudicationSection;
use Livewire\Component;

class AdjudicationCards extends Component
{
    public $adjudication;

    public $adjudication_id;

    public $adjudicationStatus;

    public $bureau;

    public $courtName;

    public $courtCaseList = [];

    public $numberOfSections;

    public $finalDecreePermission;

    public $edit_adjudication_permissions;

    public $split_and_combine_permissions;

    public $listeners = ['refreshComponent' => '$refresh'];

    public function mount($adjudication)
    {
        $this->adjudication = $adjudication;
        $this->adjudication_id = $adjudication->id;
        $this->adjudicationStatus = $adjudication->adjudication_status;

        $this->bureau = $adjudication->bureau;
        $this->courtName = 'NM Fifth Judicial District Court'; //TODO: update with the associated courts.

        $this->editAdjudicationPermissions();
        $this->splitAndCombinePermissions();
        $this->getCourtCases();
    }

    public function splitAndCombinePermissions()
    {
        // Check if the adjudication status is 'Final Decree'
        if ($this->adjudication->adjudication_status->adjudication_status_description === 'Final Decree') {
            $this->split_and_combine_permissions = 'sys-admin only';
        } else {
            $this->split_and_combine_permissions = 'sys-admin and lap admin only';
        }
    }

    public function editAdjudicationPermissions()
    {
        // Check if the adjudication status is 'Final Decree'
        if ($this->adjudication->adjudication_status->adjudication_status_description === 'Final Decree') {
            $this->edit_adjudication_permissions = 'sys-admin only';
        }
        // Check if the user has the role 'WRATS_LawClerk'
        elseif (auth()->user()->hasRole('WRATS_LawClerk')) {
            // Check if the user's bureaus contain the adjudication's bureau_id
            $userBureauIds = auth()->user()->bureaus->pluck('id')->toArray(); // Get user's bureau IDs as an array

            if (in_array($this->adjudication->bureau_id, $userBureauIds)) {

                $this->edit_adjudication_permissions = 'bureau-law-clerk-and-up';
            } else {
                // If the user's bureaus do not match the adjudication's bureau_id
                $this->edit_adjudication_permissions = 'sys-admin and lap admin only';
            }
        }
        // Default permission for other roles
        else {
            $this->edit_adjudication_permissions = 'sys-admin and lap admin only';
        }
    }

    //on click of edit in menu, emit the adjudicationId to the editAdjudication listener in AdjudicationEditSidebar.php
    public function emitId($adjudicationId)
    {
        $this->dispatch('editAdjudication', $adjudicationId);
    }

    public function emitChangeLog($adjudicationId)
    {
        $this->dispatch('changeLogAdjudication', $adjudicationId);
    }

    public function getCourtCases()
    {
        // Get Adjudication Sections by adjudication_id
        $adjudicationSections = AdjudicationSection::query()
            ->where('adjudication_id', $this->adjudication_id)
            ->pluck('id'); // Get only the ids of the sections

        //Set number of sections for card
        $this->numberOfSections = $adjudicationSections->count();

        // Get CourtCaseAdjudicationSections where adjudication_section_id matches the above.
        $courtCaseAdjudicationSections = CourtCaseAdjudicationSection::query()
            ->whereIn('adjudication_section_id', $adjudicationSections)
            ->pluck('court_case_id'); // Get only the court_case ids

        // Get all court cases associated with the adjudication sections in the last query
        // Join with related tables to enable sorting by court_name
        $courtCases = CourtCase::whereIn('court_cases.id', $courtCaseAdjudicationSections)
            ->join('courts', 'court_cases.court_id', '=', 'courts.id')
            ->select(
                'court_cases.id',
                'court_cases.case_number',
                'courts.court_name' // Attach court_name to each court case
            )
            ->orderBy('courts.court_name', 'asc') // Order by court_name in ascending order
            ->get();

        // Convert the results to an array with court case details and the attached court name
        $result = $courtCases->map(function ($courtCase) {
            return [
                'id' => $courtCase->id,
                'case_number' => $courtCase->case_number,
                'court_name' => $courtCase->court_name,
            ];
        })->toArray();

        $this->courtCaseList = $result;
    }

    public function render()
    {
        return view('livewire.components.adjudication-cards');
    }
}
