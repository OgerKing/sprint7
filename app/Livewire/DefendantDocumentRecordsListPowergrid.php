<?php

namespace App\Livewire;

use App\Models\DefendantDocument;
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

final class DefendantDocumentRecordsListPowergrid extends PowerGridComponent
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
        return DefendantDocument::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('document_title')
            ->add('subfile_id')
            ->add('document_filing_date_formatted', fn (DefendantDocument $model) => Carbon::parse($model->document_filing_date)->format('d/m/Y H:i:s'))
            ->add('attachment_URL')
            ->add('attachment_file_path')
            ->add('document_type_id')
            ->add('defendant')
            ->add('docket_id')
            ->add('is_deleted_formatted', fn (DefendantDocument $model) => Carbon::parse($model->is_deleted)->format('d/m/Y H:i:s'))
            ->add('created_by')
            ->add('updated_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Document title', 'document_title')
                ->sortable()
                ->searchable(),

            Column::make('Subfile id', 'subfile_id'),
            Column::make('Document filing date', 'document_filing_date_formatted', 'document_filing_date')
                ->sortable(),

            Column::make('Attachment URL', 'attachment_URL')
                ->sortable()
                ->searchable(),

            Column::make('Attachment file path', 'attachment_file_path')
                ->sortable()
                ->searchable(),

            Column::make('Document type id', 'document_type_id'),
            Column::make('Defendant', 'defendant')
                ->sortable()
                ->searchable(),

            Column::make('Docket id', 'docket_id')
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

    #[\Livewire\Attributes\On('editDefendantDocument')]
    public function editDefendantDocument($rowId): void
    {
        $this->redirect(route('document-management', ['type' => 'defendant', 'document_id' => $rowId]));
    }

    public function actions(DefendantDocument $row): array
    {

        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-primary')
                ->dispatch('editDefendantDocument', ['rowId' => $row->id]),
        ];
    }
}
