<?php

namespace App\Livewire\Records;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;

class AuthorizedAgentsRecordsFilter extends BaseFilter
{
    public function base(): Builder
    {
        return Person::query()
            ->whereRelation('subfile_people', 'is_authorized_agent', '>', 0);
    }
}
