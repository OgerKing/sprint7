<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class RecordsPageSelector extends Component
{
    public $selectedRecordType;

    public $recordTypes = [
        'subfiles' => 'subfiles-icon',
        'persons' => 'parties-icon',
        'authorized-agents' => 'authorized-agents-icon',
        'water-rights' => 'water-rights-icon',
        'points-of-diversion' => 'sources-icon',
        'places-of-use' => 'places-icon',
        'documents' => 'documents-icon',
    ];

    public $pages = [
        'subfiles' => 'Subfiles',
        'persons' => 'Persons',
        'authorized-agents' => 'Authorized Agents',
        'water-rights' => 'Water Rights',
        'points-of-diversion' => 'Points of Diversion',
        'places-of-use' => 'Places of Use',
        'documents' => 'Documents',
    ];

    public function mount()
    {
        // Get the current route name
        $currentRoute = Route::currentRouteName();
        // Extract the record type from the route name
        $this->selectedRecordType = explode('.', $currentRoute)[1] ?? 'subfiles';
    }

    public function selectRecordList($type)
    {
        $this->selectedRecordType = $type;

        return redirect()->route("records.{$type}");
    }

    public function render()
    {
        return view('livewire.records-page-selector');
    }
}
