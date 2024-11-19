<?php

namespace App\Livewire\Records;

use App\Models\Pod;
use App\Models\WaterRight;
use Illuminate\Database\Eloquent\Builder;

class WaterRightsRecordsFilter extends BaseFilter
{
    public $podOptions = []; // Holds the list of available pods

    public $podSelectionFilter = null; // Holds selected pod ID

    public function base(): Builder
    {
        return WaterRight::query();
    }

    protected function updatePodOptions()
    {
        $this->podOptions = Pod::whereHas('water_rights')->get(); // Get pods that have associated water rights
    }
}
