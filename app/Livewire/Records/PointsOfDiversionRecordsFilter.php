<?php

namespace App\Livewire\Records;

use App\Models\Pod;
use Illuminate\Database\Eloquent\Builder;

class PointsOfDiversionRecordsFilter extends BaseFilter
{
    public $placeOfUseOptions = []; // Holds the list of available places of use

    public $placeOfUseSelectionFilter = null; // Holds selected place of use ID

    protected function updatePlaceOfUseOptions()
    {
        $this->placeOfUseOptions = Pod::all(); // Get places of use that have associated water rights
    }

    public function base(): Builder
    {
        return Pod::query();
    }
}
