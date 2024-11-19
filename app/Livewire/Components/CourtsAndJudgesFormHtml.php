<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\CourtsAndJudgesForm;
use App\Models\AdjudicationSection;
use App\Models\Court;
use App\Models\CourtCase;
use App\Models\CourtCaseAdjudicationSection;
use App\Models\CourtPersonnel;
use App\Models\CourtRole;
use Livewire\Component;
use Livewire\WithFileUploads;

class CourtsAndJudgesFormHtml extends Component
{
    use WithFileUploads;

    public CourtsAndJudgesForm $form;

    public $adjudication_id;

    public $case_id;

    public $courtCase;

    //dropdown options
    public $courtTypeOptions;

    public $stateCourtOptions;

    public $fedCourtOptions;

    public $adjudicationSectionsOptions;

    public $federalJudgeOptions = [];

    public $courtMasterOptions = [];

    public $courtPersonnelOptions = [];

    public $selectedAdjudications = [];

    public $initialCourtId;

    public $initialJudgeId;

    public $initialCourtMasterId;

    public $initialCourtType;

    public $adjSectionsFormCopy = []; //keeps checkmarks in adjudication section(s) dropdown up to date

    public $adjSectionsChips = []; //displays adj section name for selected items from checkbox

    public $allAdjSections = [];

    protected $listeners = ['setCourtCaseId', 'resetCourtsAndJudgesFields'];

    public function mount()
    {
        $this->loadCourtTypes();
        $this->loadDistrictOptionsByCourtType();
        $this->loadAdjudicationSectionsOptions();
        $this->loadFederalJudgeOptions();
        $this->loadCourtMasterOptions();

        $this->allAdjSections = AdjudicationSection::query()->get();
    }

    public function setCourtCaseId($court_case_id)
    {
        $court_case = CourtCase::with('adjudication_sections')->find($court_case_id);
        $this->courtCase = $court_case;
        $this->case_id = $court_case_id;
        $this->form->setCourtCase($court_case);

        if ($court_case) {

            // Set adjudication sections in form. Map through adjudicationSections to get the IDs
            $adjudicationSectionIds = $court_case->adjudication_sections->map(function ($section) {
                return $section->id;
            });
            //Assign the IDs to the form property
            $this->form->adjudication_sections = $adjudicationSectionIds->toArray();

            $this->adjSectionsFormCopy = $this->form->adjudication_sections;
            $this->adjSectionsChips = $this->mapIdsToNames($this->adjSectionsFormCopy, $this->allAdjSections);

            //set initial values for judge and court_id to reset if user toggles between Court Types
            $this->initialCourtType = $court_case->court->court_type;
            $this->initialCourtId = $court_case->court->id;
            $this->initialCourtMasterId = $court_case->court_master_id;
            $this->initialJudgeId = $court_case->court_judge_id;
        }

        $this->loadDistrictJudgesByCourt();
    }

    //This is for the chips that display underneath Adjudication Section(s) dropdown
    public function mapIdsToNames(array $ids, $sections)
    {
        // Make a map of ID to name
        $idToNameMap = $sections->pluck('adjudication_section_name', 'id')->toArray();

        //return the names for the given IDs
        $filteredMap = array_intersect_key($idToNameMap, array_flip($ids));

        return $filteredMap;
    }

    public function loadCourtTypes()
    {

        $this->courtTypeOptions = [
            [
                'label' => 'State (NM)',
                'value' => 'State',
            ],
            [
                'label' => 'Federal',
                'value' => 'Federal',
            ],
        ];
    }

    public function loadDistrictOptionsByCourtType()
    {
        $stateCourts = Court::where('court_type', 'State')->get(['id', 'court_name']);

        $fedCourts = Court::where('court_type', 'Federal')->get(['id', 'court_name']);

        foreach ($stateCourts as $court) {
            $stateCourtOptions[] = [
                'label' => $court->court_name,
                'value' => $court->id,
            ];
        }
        foreach ($fedCourts as $court) {
            $fedCourtOptions[] = [
                'label' => $court->court_name,
                'value' => $court->id,
            ];
        }

        $this->stateCourtOptions = $stateCourtOptions;
        $this->fedCourtOptions = $fedCourtOptions;
    }

    public function loadFederalJudgeOptions()
    {
        $federalRoleId = CourtRole::where('court_role', 'UNITED STATES DISTRICT JUDGE')->pluck('id'); //TODO: CONFIRM that this is the correct role.

        $courtPersonnel = CourtPersonnel::whereIn('court_role_id', $federalRoleId)->get();

        $federalJudgeOptions = [];

        foreach ($courtPersonnel as $judge) {
            $federalJudgeOptions[] = [
                'label' => $judge->first_name.' '.$judge->last_name,
                'value' => $judge->id,
            ];
        }

        $this->federalJudgeOptions = $federalJudgeOptions;
    }

    public function loadCourtMasterOptions()
    {
        $courtMasterRoleId = CourtRole::where('court_role', 'SPECIAL MASTER')->pluck('id');

        $courtPersonnel = CourtPersonnel::whereIn('court_role_id', $courtMasterRoleId)->get();

        $courtMasterOptions = [];

        foreach ($courtPersonnel as $master) {
            $courtMasterOptions[] = [
                'label' => $master->first_name.' '.$master->last_name,
                'value' => $master->id,
            ];
        }

        $this->courtMasterOptions = $courtMasterOptions;
    }

    public function loadAdjudicationSectionsOptions()
    {
        $adjudicationSections = AdjudicationSection::where('adjudication_id', $this->adjudication_id)->get();

        $adjSectionOptions = [];
        foreach ($adjudicationSections as $section) {
            $adjSectionOptions[] = [
                'label' => $section->adjudication_section_name,
                'value' => $section->id,
            ];
        }

        $this->adjudicationSectionsOptions = $adjSectionOptions;
    }

    public function selectSections($sectionId)
    {
        $section = intval($sectionId);

        // Convert to array if it’s not already an array
        if (in_array($sectionId, $this->form->adjudication_sections)) {
            $findKey = array_search($section, $this->form->adjudication_sections);

            unset($this->form->adjudication_sections[$findKey]);
            $this->form->adjudication_sections = array_values($this->form->adjudication_sections);
        } else {
            // Add the section ID if not selected
            $this->form->adjudication_sections[] = $section;
        }

        // Ensure the array is unique
        $this->form->adjudication_sections = array_unique($this->form->adjudication_sections);
        $this->adjSectionsFormCopy = $this->form->adjudication_sections;

        $this->adjSectionsChips = $this->mapIdsToNames($this->adjSectionsFormCopy, $this->allAdjSections);
    }

    public function loadDistrictJudgesByCourt()
    {
        // Check if a court ID is selected before proceeding
        if (! $this->form->court_id) {
            // If no court is selected, clear the options
            $this->courtPersonnelOptions = [];

            return;
        }

        $courtPersonnel = CourtPersonnel::where('court_id', $this->form->court_id)->get();

        $courtPersonnelOptions = [];
        foreach ($courtPersonnel as $judge) {
            $courtPersonnelOptions[] = [
                'label' => $judge->first_name.' '.$judge->last_name,
                'value' => $judge->id,
            ];
        }

        $this->courtPersonnelOptions = $courtPersonnelOptions;
    }

    public function courtTypeChanged()
    {
        if ($this->form->court_type === $this->initialCourtType) {
            $this->form->court_id = $this->initialCourtId;
            $this->form->court_judge_id = $this->initialJudgeId;
            $this->form->court_master_id = $this->initialCourtMasterId;
        } else {
            $this->form->court_id = null;
            $this->form->court_judge_id = null;
            $this->form->court_master_id = null;
        }
        if ($this->form->court_type === 'Federal') {
            $this->form->court_id = 1;
        }
    }

    public function deleteJudgeSignature($courtCaseId)
    {
        $courtCase = CourtCase::findOrFail($courtCaseId);
        $courtCase->court_judge_signature = null;
        $courtCase->save();

        $this->courtCase = $courtCase;
    }

    public function deleteMasterSignature($courtCaseId)
    {
        $courtCase = CourtCase::findOrFail($courtCaseId);
        $courtCase->court_master_signature = null;
        $courtCase->save();

        $this->courtCase = $courtCase;
    }

    public function save()
    {
        $this->validate();
        $userId = auth()->user()->id;

        $courtJudgeSignature = null;
        if ($this->form->court_judge_signature) {
            $courtJudgeSignature = $this->form->court_judge_signature->storePublicly('signatures');
        }

        $courtMasterSignature = null;
        if ($this->form->court_master_signature) {
            $courtMasterSignature = $this->form->court_master_signature->storePublicly('signatures');
        }

        // if there is a case_id, it's an update
        if ($this->case_id) {
            // Update existing case
            $courtCase = CourtCase::findOrFail($this->case_id);

            $courtCase->update([
                'court_id' => $this->form->court_id,
                'court_judge_id' => $this->form->court_judge_id,
                'court_master_id' => $this->form->court_type === 'Federal' ? $this->form->court_master_id : null,
                'case_name' => $this->form->case_name,
                'case_number' => $this->form->case_number,
                'court_docket_link' => $this->form->court_docket_link,
                'court_judge_signature' => $courtJudgeSignature ?? $courtCase->court_judge_signature,
                'court_master_signature' => $courtMasterSignature ?? $courtCase->court_master_signature,
            ]);

            session()->flash('success', 'Case updated successfully.');
        } else {
            // Create new case
            $courtCase = CourtCase::create([
                'court_id' => $this->form->court_id,
                'court_judge_id' => $this->form->court_judge_id,
                'court_master_id' => $this->form->court_type == 'Federal' ? $this->form->court_master_id : null,
                'case_name' => $this->form->case_name,
                'case_number' => $this->form->case_number,
                'court_docket_link' => $this->form->court_docket_link,
                'created_by' => $userId,
                'updated_by' => $userId,
                'court_judge_signature' => $courtJudgeSignature,
                'court_master_signature' => $courtMasterSignature,
            ]);

            $this->case_id = $courtCase->id; // Set the case_id for future updates

            session()->flash('success', 'Case created successfully.');
        }

        $this->dispatch('refreshCourtsList'); // refresh the table

        // Retrieve existing adjudication sections for the court case
        $existingSections = CourtCaseAdjudicationSection::where('court_case_id', $courtCase->id)->pluck('adjudication_section_id')->toArray();

        // Convert form adjudication sections to an array of integers
        $formSections = array_map('intval', $this->form->adjudication_sections);

        // Identify sections to remove (those in the existing sections but not in the form sections)
        $sectionsToRemove = array_diff($existingSections, $formSections);

        // Remove sections that are no longer in the form
        if ($sectionsToRemove) {
            CourtCaseAdjudicationSection::where('court_case_id', $courtCase->id)
                ->whereIn('adjudication_section_id', $sectionsToRemove)
                ->delete();
        }

        // Identify sections to add (those in the form but not in the existing sections)
        $sectionsToAdd = array_diff($formSections, $existingSections);

        // Add new sections
        foreach ($sectionsToAdd as $sectionId) {
            CourtCaseAdjudicationSection::create([
                'court_case_id' => $courtCase->id,
                'adjudication_section_id' => $sectionId,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);
        }

        // Emit success flash message and close modal
        $this->dispatch('flashMessage', session('success'), 'success');
        $this->dispatch('hide-courts-modal');
    }

    public function resetCourtsAndJudgesFields()
    {
        $this->case_id = null;
        $this->courtCase = null;
        $this->initialCourtId = null;
        $this->initialJudgeId = null;
        $this->initialCourtMasterId = null;
        $this->initialCourtType = null;

        $this->form->court_type = '';
        $this->form->court_id = '';
        $this->form->court_name = '';
        $this->form->court_judge_id = '';
        $this->form->court_master_id = '';
        $this->form->adjudication_sections = [];
        $this->form->case_name = '';
        $this->form->case_number = '';
        $this->form->court_docket_link = '';

        $this->resetValidation();
        $this->dispatch('hide-courts-modal');
    }

    public function render()
    {
        return view('livewire.components.courts-and-judges-form-html');
    }
}
