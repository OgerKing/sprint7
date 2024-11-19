<?php

namespace App\Livewire;

use App\Models\GlobalDocumentPOD;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentPODPowergrid extends PowerGridComponent
{
    use WithExport;

    public $documentId;

    public function datasource(): Builder
    {
        return GlobalDocumentPOD::query()->where('global_document_id', $this->documentId)->with('pod');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('POD_id')
            ->add('pod_nbr', fn ($pod) => $pod->pod->pod_nbr);
    }

    public function columns(): array
    {
        return [
            Column::make('SID', 'POD_id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('POD #', 'pod_nbr')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
        ];
    }
}
