<?php

namespace App\Livewire;

use App\Models\AdjudicationDocument;
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

final class AdjudicationDocumentRecordsListPowergrid extends PowerGridComponent
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
        return AdjudicationDocument::query();
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
            ->add('adjudication_document_code')
            ->add('adjudication_document_title')
            ->add('document_type_id')
            ->add('document_filing_date_formatted', fn (AdjudicationDocument $model) => Carbon::parse($model->document_filing_date)->format('d/m/Y H:i:s'))
            ->add('attachment_URL')
            ->add('attachment_file_path')
            ->add('is_deleted_formatted', fn (AdjudicationDocument $model) => Carbon::parse($model->is_deleted)->format('d/m/Y H:i:s'))
            ->add('created_by')
            ->add('updated_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Subfile id', 'subfile_id'),
            Column::make('Adjudication document code', 'adjudication_document_code')
                ->sortable()
                ->searchable(),

            Column::make('Adjudication document title', 'adjudication_document_title')
                ->sortable()
                ->searchable(),

            Column::make('Document type id', 'document_type_id'),
            Column::make('Document filing date', 'document_filing_date_formatted', 'document_filing_date')
                ->sortable(),

            Column::make('Attachment URL', 'attachment_URL')
                ->sortable()
                ->searchable(),

            Column::make('Attachment file path', 'attachment_file_path')
                ->sortable()
                ->searchable(),

            Column::make('Is deleted', 'is_deleted_formatted', 'is_deleted')
                ->sortable(),

            Column::make('Created by', 'created_by')
                ->sortable()
                ->searchable(),

            Column::make('Updated by', 'updated_by')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('document_filing_date'),
            Filter::datetimepicker('is_deleted'),
        ];
    }

    #[\Livewire\Attributes\On('editAdjudicationDocument')]
    public function editAdjudicationDocument($rowId): void
    {
        $this->redirect(route('document-management', ['type' => 'adjudication', 'document_id' => $rowId]));
    }

    public function actions(AdjudicationDocument $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-primary')
                ->dispatch('editAdjudicationDocument', ['rowId' => $row->id]),
        ];
    }
}
