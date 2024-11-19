<?php

namespace App\Livewire;

use App\Models\GlobalDocumentWaterRight;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentWaterRightsPowergrid extends PowerGridComponent
{
    use WithExport;

    public $documentId;

    public function setUp(): array
    {

        return [

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return GlobalDocumentWaterRight::query()->where('global_document_id', $this->documentId);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('water_right_id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            Column::make('Water right id', 'water_right_id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

        ];
    }
}
