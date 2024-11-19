<?php

namespace App\Livewire;

use App\Models\GlobalDocument;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentRecordsListPowergrid extends PowerGridComponent
{
    use WithExport;

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
        return GlobalDocument::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('subfile_id')
            ->add('global_document_title')
            ->add('document_filing_date_formatted', fn (GlobalDocument $model) => Carbon::parse($model->document_filing_date)->format('d/m/Y H:i:s'))
            ->add('attachment_link')
            ->add('global_document_type_id')
            ->add('docket_id')
            ->add('global_desc')
            ->add('global_id_access')
            ->add('created_by')
            ->add('updated_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            Column::make('Subfile id', 'subfile_id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            Column::make('Global document title', 'global_document_title')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80')
                ->sortable()
                ->searchable(),

            Column::make('Document filing date', 'document_filing_date_formatted', 'document_filing_date')
                ->sortable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Global document type id', 'global_document_type_id'),
            Column::make('Docket id', 'docket_id')
                ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            // Column::make('Attachment link', 'attachment_link')
            //     ->sortable()
            //     ->searchable()
            //     ->bodyAttribute('sas-body-class width-80')
            //     ->headerAttribute('wrats-custom-column width-80'),

            // Column::make('Global desc', 'global_desc')
            //     ->sortable()
            //     ->searchable()
            //     ->bodyAttribute('sas-body-class width-80')
            //     ->headerAttribute('wrats-custom-column width-80'),

            // Column::make('Global id access', 'global_id_access'),
            // Column::make('Created by', 'created_by')
            //     ->sortable()
            //     ->searchable()
            //     ->bodyAttribute('sas-body-class width-80')
            //     ->headerAttribute('wrats-custom-column width-80'),

            // Column::make('Updated by', 'updated_by')
            //     ->sortable()
            //     ->searchable()
            //     ->bodyAttribute('sas-body-class width-80')
            //     ->headerAttribute('wrats-custom-column width-80'),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable()
            //     ->bodyAttribute('sas-body-class width-80')
            //     ->headerAttribute('wrats-custom-column width-80'),

            // Column::make('Created at', 'created_at')
            //     ->sortable()
            //     ->searchable()
            //     ->bodyAttribute('sas-body-class width-80')
            //     ->headerAttribute('wrats-custom-column width-80'),

            Column::action('Action')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('document_filing_date'),
        ];
    }

    #[\Livewire\Attributes\On('editGlobalDocument')]
    public function editGlobalDocument($rowId): void
    {
        $this->redirect(route('document-management', ['type' => 'global', 'document_id' => $rowId]));
    }

    public function actions(GlobalDocument $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-primary')
                ->dispatch('editGlobalDocument', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
