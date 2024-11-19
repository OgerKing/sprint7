<?php

namespace App\Livewire;

use App\Models\GlobalDocument;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentsPowergrid extends PowerGridComponent
{
    use WithExport;

    public $adjudication_id;

    protected $listeners = ['refreshDocumentsList'];

    public function refreshDocumentsList()
    {
        // Refresh the component to reload the data
        $this->dispatch('$refresh');
    }

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
        return GlobalDocument::where('adjudication_id', $this->adjudication_id);
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
            ->add('global_desc', function ($document) {
                if ($document->global_desc) {
                    return $this->truncateText($document->global_desc, 20);
                }
            })
            ->add('global_id_access')
            ->add('created_by', function ($document) {
                if ($document->created_by) {
                    return $this->truncateText($document->created_by, 20);
                }
            })
            ->add('updated_by', function ($document) {
                if ($document->updated_by) {
                    return $this->truncateText($document->updated_by, 20);
                }
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Global document title', 'global_document_title')
                ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Document filing date', 'document_filing_date_formatted', 'document_filing_date')
                ->sortable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Global document type id', 'global_document_type_id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Docket id', 'docket_id')
                ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Global desc', 'global_desc')
                ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Updated by', 'updated_by')
                ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::action('Action')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::datetimepicker('document_filing_date'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->dispatch('setGlobalDocumentId', $rowId);
    }

    public function actions(GlobalDocument $row): array
    {
        return [
            Button::add('custom')
                ->render(function ($row) {
                    return Blade::render(<<<HTML
                <div class="dropdown">

  <i class="bi bi-three-dots-vertical btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item"
                type="button" 
                data-bs-target="#globalDocumentsModal"
                data-bs-toggle="modal"
                data-bs-dismiss="modal" 
                wire:click="edit($row->id)">Edit</button></li>
    <li><button class="dropdown-item text-danger" type="button" onclick="confirm('Are you sure you want to delete this Global Document?')">Delete</button></li>
  </ul>
</div>
HTML);
                }),

        ];
    }

    private function truncateText(string $text, int $length): string
    {
        if (strlen($text) > $length) {
            return substr($text, 0, $length).'...';
        }

        return $text;
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
