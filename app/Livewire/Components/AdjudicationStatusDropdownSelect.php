<?php

namespace App\Livewire\Components;

use App\Models\AdjudicationStatus;
use Livewire\Component;

class AdjudicationStatusDropdownSelect extends Component
{
    public $statusOptions = [];

    public $selectedAdjudicationStatuses = [];

    //listener for clearing all dropdown filters.
    protected $listeners = ['clearDropdown'];

    public function mount($selectedAdjudicationStatuses = [])
    {
        $this->selectedAdjudicationStatuses = $selectedAdjudicationStatuses;
        $this->fetchStatuses();
    }

    public function fetchStatuses()
    {

        $adjudicationStatuses = AdjudicationStatus::get();

        $statusOptions = [];
        foreach ($adjudicationStatuses as $status) {
            $statusOptions[] = [
                'label' => $status->adjudication_status_description,
                'value' => $status->id,
            ];
        }
        $this->statusOptions = $statusOptions;
    }

    public function selectStatuses($status)
    {
        // if $status is already in the array, remove it. if it's not in the array,add it.
        if (in_array($status, $this->selectedAdjudicationStatuses)) {
            $this->selectedAdjudicationStatuses = array_diff($this->selectedAdjudicationStatuses, [$status]);
        } else {
            $this->selectedAdjudicationStatuses[] = $status;
        }
        $this->dispatch('adjudicationStatusSelected', $this->selectedAdjudicationStatuses);
    }

    //clear the dropdown value
    public function clearDropdown()
    {
        $this->selectedAdjudicationStatuses = [];
    }

    // this listens for selectedAdjudicationStatuses on update. if none, clear the dropdown.
    public function updatedSelectedAdjudicationStatuses($value)
    {
        if (empty($value)) {
            $this->clearDropdown();
        }
    }

    public function render()
    {
        return view('livewire.components.adjudication-status-dropdown-select');
    }
}
