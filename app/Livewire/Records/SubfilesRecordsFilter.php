<?php

namespace App\Livewire\Records;

use App\Models\Subfile;
use Illuminate\Database\Eloquent\Builder;

class SubfilesRecordsFilter extends BaseFilter
{
    //TODO: needs to be refactored specifically for the subfiles records table
    public bool $showFilters = false;

    public $subfileSelectionFilter = null; // Hold selected subfile ID

    public function base(): Builder
    {
        return Subfile::query();
    }
}
