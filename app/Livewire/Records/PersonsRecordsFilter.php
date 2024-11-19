<?php

namespace App\Livewire\Records;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;

class PersonsRecordsFilter extends BaseFilter
{
    public function base(): Builder
    {
        return Person::query();
    }
}
