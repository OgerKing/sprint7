<?php

namespace App\Livewire\Views;

use App\Models\Adjudication;
use App\Models\AdjudicationSection;
use Livewire\Attributes\Url;
use Livewire\Component;

//This livewire file is for the Split functionality. Pairs with resources/views/livewire/views/split-view.blade.php
class SplitView extends Component
{
    #[Url]
    public $adjudication_id; // Get from URL

    public $adjudication;

    public $adjudicationName;

    public $availableSections = []; //a list of sections to choose from to assign to each adjudication. begins as an array of sections associated with the original adjudication;

    public $selectedSections = []; //sections that have been selected and primed to attatch to an adjudication.

    public $assignedToOriginal = []; //the sections the user assigns to the original adjudication.

    public $assignedToNew = []; //the sections the user assigns to the new adjudication

    public $originalSectionNames = []; //array of section names that populate the chips for the original adjudication.

    public $newSectionNames = []; //array of section names that populate the chips for the new adjudication;

    public $hasNoSections = false; //if adjudication has no sections

    public function mount()
    {
        $this->adjudication = Adjudication::findOrFail($this->adjudication_id); //get the selected adjudication by id
        $this->adjudicationName = $this->adjudication->adjudication_name; //set name

        $this->getAdjudicationSections();
    }

    public function getAdjudicationSections()
    {
        //get all of the sections associated with this adjudication, except any sections that have a parent aka are subsections.
        $this->availableSections = AdjudicationSection::with('subsections')
            ->where('adjudication_id', $this->adjudication_id)
            ->whereDoesntHave('parentSubsection')  // exclude sections that are children
            ->get()
            ->toArray();

        if (count($this->availableSections) == 0) {
            $this->hasNoSections = true;
        }
    }

    public function removeFromOriginalAdjudication($id)
    {
        //if a user clicks the X on a chip for a selected section, this function removes it from the assignedToOriginal array.

        //remove the section from assignedToOriginal
        $this->assignedToOriginal = array_filter($this->assignedToOriginal, function ($sectionId) use ($id) {
            return $sectionId != $id;
        });

        //move the section back to availableSections
        $section = AdjudicationSection::with('subsections')->find($id);
        if ($section) {
            $this->availableSections[] = $section->toArray();
        }

        //recompute the originalSectionNames
        $this->originalSectionNames = AdjudicationSection::whereIn(
            'id',
            $this->assignedToOriginal
        )
            ->pluck('adjudication_section_name', 'id')
            ->toArray();
    }

    public function removeFromNewAdjudication($id)
    {
        //if a user clicks the X on a chip for a selected section, this function removes it from the assignedToNew array.

        //remove the section from assignedToNew
        $this->assignedToNew = array_filter($this->assignedToNew, function ($sectionId) use ($id) {
            return $sectionId != $id;
        });

        //move the section back to availableSections
        $section = AdjudicationSection::with('subsections')->find($id);
        if ($section) {
            $this->availableSections[] = $section->toArray();
        }

        //recompute the newSectionNames
        $this->newSectionNames = AdjudicationSection::whereIn(
            'id',
            $this->assignedToNew
        )
            ->pluck('adjudication_section_name', 'id')
            ->toArray();
    }

    public function addToOriginalAdjudication()
    {
        //convert $assignedToOriginal to an array if it’s not already
        if (is_object($this->assignedToOriginal)) {
            $this->assignedToOriginal = array_map(fn ($section) => $section['id'], $this->assignedToOriginal);
        }

        //merge selected sections into the existing assigned sections
        $this->assignedToOriginal = array_merge($this->assignedToOriginal, $this->selectedSections);

        //remove the assigned sections from availableSections
        $this->availableSections = array_filter($this->availableSections, function ($section) {
            return ! in_array($section['id'], $this->selectedSections);
        });

        //recompute originalSectionNames
        $this->originalSectionNames = AdjudicationSection::whereIn(
            'id',
            $this->assignedToOriginal
        )
            ->pluck('adjudication_section_name', 'id')
            ->toArray();

        //clear the selectedSections
        $this->selectedSections = [];
    }

    public function addToNewAdjudication()
    {
        //convert $assignedToNew to an array if it’s not already
        if (is_object($this->assignedToNew)) {
            $this->assignedToNew = array_map(fn ($section) => $section['id'], $this->assignedToNew);
        }

        //merge selected sections into the existing assigned sections
        $this->assignedToNew = array_merge($this->assignedToNew, $this->selectedSections);

        //remove the assigned sections from availableSections
        $this->availableSections = array_filter($this->availableSections, function ($section) {
            return ! in_array($section['id'], $this->selectedSections);
        });

        //recompute newSectionNames
        $this->newSectionNames = AdjudicationSection::whereIn(
            'id',
            $this->assignedToNew
        )
            ->pluck('adjudication_section_name', 'id')
            ->toArray();

        //clear the selectedSections
        $this->selectedSections = [];
    }

    public function submit()
    {
        $userId = auth()->user()->id;

        //all we really need to update on the original adjudication is the name. Once we reassign the selected sections to the new adjudication, the selections assigned to original are already theirs in the db.

        // get and update the original adjudication
        $originalAdjudication = Adjudication::findOrFail($this->adjudication_id);

        // Create a new adjudication with the same details
        $newAdjudication = Adjudication::create([
            'adjudication_name' => $this->adjudicationName.' - B',
            'prefix' => $originalAdjudication->prefix,
            'adjudication_nickname' => $originalAdjudication->adjudication_nickname,
            'adjudication_status_id' => $originalAdjudication->adjudication_status_id,
            'adjudication_district_id' => $originalAdjudication->adjudication_district_id,
            'bureau_id' => $originalAdjudication->bureau_id,
            'coordinate_system' => $originalAdjudication->coordinate_system,
            'adjudication_boundary_map_link' => $originalAdjudication->adjudication_boundary_map_link,
            'created_by' => $userId,
            'updated_by' => $userId,
            'hydrographic_survey_description' => $originalAdjudication->hydrographic_survey_description,
        ]);

        // Attach sections to the new adjudication
        foreach ($this->assignedToNew as $sectionId) {
            $section = AdjudicationSection::find($sectionId);
            if ($section) {
                // Attach section to the new adjudication
                $newAdjudication->adjudication_sections()->save($section);

                // Update subsections' adjudication_id to the new adjudication
                foreach ($section->subsections as $subsection) {
                    //get the adjudication section that matches teh subsection id. Update the sections adjudication_id with the new adjudication.
                    $subsectionRowInSection = AdjudicationSection::where('id', $subsection->child_adjudication_subsection_id)->first();

                    if ($subsectionRowInSection) {
                        $subsectionRowInSection->adjudication_id = $newAdjudication->id;
                        $subsectionRowInSection->save();
                    }
                }
            }
        }

        // Update the original adjudication details
        $originalAdjudication->update([
            'adjudication_name' => $this->adjudicationName.' - A',
            'updated_by' => $userId,
        ]);

        $this->redirectRoute('adjudications');
        session()->flash('success', 'Adjudication successfully split');
        $this->dispatch('flashMessage', session('success'), 'success');
    }

    public function cancelConfirmation()
    {
        $this->redirectRoute('adjudications');
    }

    public function render()
    {
        return view('livewire.views.split-view');
    }
}
