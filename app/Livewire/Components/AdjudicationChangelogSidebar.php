<?php

namespace App\Livewire\Components;

use App\Models\Adjudication;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class AdjudicationChangelogSidebar extends Component
{
    public $adjudication;

    public $changelog; // It will be a Collection

    public $selectedDate;

    public $allDates = []; // To store all unique dates

    public $loading = false; // Initialize loading state

    protected $listeners = ['changeLogAdjudication'];

    public function mount()
    {
        $this->selectedDate = null; // Initialize the selected date
        $this->changelog = collect(); // Initialize as a Collection
    }

    public function changeLogAdjudication($adjudicationId)
    {
        $this->loading = true; // Set loading state to true
        $this->changelog = collect(); // Clear previous data

        try {
            $this->adjudication = Adjudication::find($adjudicationId);
            if ($this->adjudication) {
                $this->changelog = collect($this->adjudication->getChangelog());
                $this->allDates = $this->changelog->keys()->toArray();
            }
        } catch (ModelNotFoundException $e) {
            session()->flash('status', 'Adjudication not found.');
            session()->flash('status_type', 'error');
        } catch (Exception $e) {
            session()->flash('status', 'An error occurred: '.$e->getMessage());
            session()->flash('status_type', 'error');
        } finally {
            $this->loading = false; // Reset loading state after data fetching
        }
        $this->dispatch('show-offcanvas-changelog'); // Open the sidebar form.
    }

    public function updatedSelectedDate($date)
    {
        // Update the changelog based on the selected date
        $this->loading = true; // Set loading to true
        $this->updateChangelog();
    }

    public function updateChangelog()
    {
        // Logic to filter the changelog by selected date
        if ($this->selectedDate) {
            $this->changelog = $this->adjudication->getChangelogByDate($this->selectedDate);
        } else {
            // Reset to show all changes
            $this->changelog = collect($this->adjudication->getChangelog());
        }
        $this->changelog = collect($this->changelog); // Ensure it's a collection
        $this->loading = false; // Set loading to false after updating
    }

    public function jumpToFirstDate()
    {
        // Logic to jump to the first date in the changelog
        if ($this->changelog->isNotEmpty()) {
            $this->selectedDate = $this->changelog->keys()->first();
            $this->updateChangelog(); // Update the changelog display
        }
    }

    public function closeModal()
    {
        $this->loading = true; // Reset loading state
        $this->changelog = collect(); // Clear changelog data
        $this->allDates = []; // Clear dates
    }

    public function render()
    {
        return view('livewire.components.adjudication-changelog-sidebar');
    }
}
