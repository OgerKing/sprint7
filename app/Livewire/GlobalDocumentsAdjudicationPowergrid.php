<?php

namespace App\Livewire;

use App\Models\Adjudication;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentsAdjudicationPowergrid extends PowerGridComponent
{
    use WithExport;

    public $adjudicationId;

    public function datasource(): Builder
    {
        return Adjudication::query()->where('id', $this->adjudicationId);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('adjudication_name');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            Column::make('Adjudication', 'adjudication_name')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
        ];
    }
}
