<?php

namespace App\Livewire;

use App\Models\HydrographicDocument;
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

final class HydrographicDocumentRecordsListPowergrid extends PowerGridComponent
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
        return HydrographicDocument::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('subfile_id')
            ->add('hydrographic_document_title')
            ->add('hydrographic_document_filing_date_formatted', fn (HydrographicDocument $model) => Carbon::parse($model->hydrographic_document_filing_date)->format('d/m/Y H:i:s'))
            ->add('attachment_URL')
            ->add('attachment_file_path')
            ->add('document_type_id')
            ->add('hydrographic_document_owner')
            ->add('hydrographic_document_owner_status')
            ->add('hydrographic_document_owner_type')
            ->add('is_deleted_formatted', fn (HydrographicDocument $model) => Carbon::parse($model->is_deleted)->format('d/m/Y H:i:s'))
            ->add('created_by')
            ->add('updated_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Subfile id', 'subfile_id'),
            Column::make('Hydrographic document title', 'hydrographic_document_title')
                ->sortable()
                ->searchable(),

            Column::make('Hydrographic document filing date', 'hydrographic_document_filing_date_formatted', 'hydrographic_document_filing_date')
                ->sortable(),

            Column::make('Attachment URL', 'attachment_URL')
                ->sortable()
                ->searchable(),

            Column::make('Attachment file path', 'attachment_file_path')
                ->sortable()
                ->searchable(),

            Column::make('Document type id', 'document_type_id'),
            Column::make('Hydrographic document owner', 'hydrographic_document_owner')
                ->sortable()
                ->searchable(),

            Column::make('Hydrographic document owner status', 'hydrographic_document_owner_status')
                ->sortable()
                ->searchable(),

            Column::make('Hydrographic document owner type', 'hydrographic_document_owner_type')
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
            Filter::datetimepicker('hydrographic_document_filing_date'),
            Filter::datetimepicker('is_deleted'),
        ];
    }

    #[\Livewire\Attributes\On('editHydrographicDocument')]
    public function editHydrographicDocument($rowId): void
    {
        $this->redirect(route('document-management', ['type' => 'hydrographic', 'document_id' => $rowId]));
    }

    public function actions(HydrographicDocument $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-primary')
                ->dispatch('editHydrographicDocument', ['rowId' => $row->id]),
        ];
    }
}
