<?php

namespace App\Livewire\Views;

use App\Models\Adjudication;
use App\Models\Bureau;
use Livewire\Component;

class AdjudicationCases extends Component
{
    public $adjudications;

    public $bureauOptions = [];

    public $statusFilters = [];

    public $selectedBureau = null;

    public $search = '';

    public $showFilters = false;

    protected $listeners = ['adjudicationStatusSelected', 'selectBureau'];

    public function mount()
    {
        $this->loadAdjudications();
        $this->loadBureaus();
    }

    public function toggleFilters()
    {
        $this->showFilters = ! $this->showFilters;
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

    public function loadAdjudications()
    {

        $query = Adjudication::with('adjudication_status', 'bureau')->orderBy('adjudication_name', 'asc');

        if ($this->selectedBureau) {
            $query->where('bureau_id', $this->selectedBureau);
        }

        if (! empty($this->statusFilters)) {

            $query->whereIn('adjudication_status_id', $this->statusFilters);
        }

        if (! empty($this->search)) {
            $query->where('adjudication_name', 'like', '%'.$this->search.'%');
        }

        $this->adjudications = $query->take(250)->get();
    }

    public function selectBureau($value)
    {
        $this->selectedBureau = $value;
    }

    public function adjudicationStatusSelected($value)
    {
        $this->statusFilters = $value;
    }

    public function applyFilters()
    {
        $this->loadAdjudications();
    }

    public function updatedSearch()
    {
        $this->loadAdjudications();
    }

    public function resetFilters()
    {
        $this->statusFilters = [];
        $this->selectedBureau = null;
        $this->search = '';
        $this->dispatch('clearDropdown');
    }

    public function clearAll()
    {
        $this->resetFilters();
        $this->loadAdjudications();
    }

    public function cancelFilter()
    {
        $this->resetFilters();
        $this->loadAdjudications();
        $this->toggleFilters();
    }

    public function render()
    {
        return view('livewire.views.adjudication-cases', [
            'adjudications' => $this->adjudications,
            'bureauOptions' => $this->bureauOptions,
            'selectedBureau' => $this->selectedBureau,
            'statusFilters' => $this->statusFilters,
        ]);
    }
}
