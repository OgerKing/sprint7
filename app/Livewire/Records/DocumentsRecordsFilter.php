<?php

namespace App\Livewire\Records;

use Livewire\Component;

class DocumentsRecordsFilter extends Component
{
    //TODO: Functionality Coming Soon
    public bool $showFilters = false; // Controls the visibility of the filter section

    public $disabled; // Holds the disabled state of the component

    public function mount($disabled = false)
    {
        $this->disabled = $disabled;
    }

    public function toggleFilters()
    {
        $this->showFilters = ! $this->showFilters; // Toggle the visibility of filters
    }

    public function cancelFilter()
    {
        $this->clearAll(); // Clear all filters and hide the filter section
        $this->toggleFilters(); // Close filters
    }

    public function clearAll()
    {
        // $this->subfileSelectionFilter = null;
        $this->resetFilters(); // Reset filters in the parent component
    }

    public function applyFilters()
    {
        $this->resetFilters(); // Apply the selected filters to the parent component
    }

    protected function resetFilters()
    {
        //TODO: Coming Soon.
        // Update the parent component with selected filters
        // $this->dispatch('filterChanged', [
        //     'subfile' => $this->subfileSelectionFilter,
        //     'place_of_use' => $this->placeOfUseSelectionFilter,
        // ]);
    }

    public function render()
    {
        return view('livewire.records.documents-records-filter');
    }
}
