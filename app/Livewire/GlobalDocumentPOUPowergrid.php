<?php

namespace App\Livewire;

use App\Models\GlobalDocumentPOU;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentPOUPowergrid extends PowerGridComponent
{
    use WithExport;

    public $documentId;

    public function setUp(): array
    {

        return [];
    }

    public function datasource(): Builder
    {
        return GlobalDocumentPOU::query()->where('global_document_id', $this->documentId)->with('pou'); //TODO: need to get subfiles relationship
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('PLID', fn ($pou) => $pou->id)
            ->add(
                'subfiles'
            ); //TODO: add related subfiles
    }

    public function columns(): array
    {
        return [
            Column::make('PLID', 'PLID')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            Column::make('Subfiles', 'subfiles')->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

        ];
    }
}
