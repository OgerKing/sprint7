<?php

namespace App\Livewire;

use App\Models\GlobalDocumentPerson;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentPersonPowergrid extends PowerGridComponent
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

        return GlobalDocumentPerson::query()
            ->where('global_document_persons.global_document_id', $this->documentId)
            ->join('persons', 'global_document_persons.person_id', '=', 'persons.id')
            ->leftJoin('global_document_subfiles', 'global_document_persons.global_document_id', '=', 'global_document_subfiles.global_document_id')
            ->leftJoin('subfile_court_cases', 'global_document_subfiles.subfile_id', '=', 'subfile_court_cases.subfile_id')
            ->select(
                'global_document_persons.id',
                'global_document_persons.person_id',
                'persons.first_name',
                'persons.last_name',
                'subfile_court_cases.case_number'
            );
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()

            ->add('id')
            ->add('person_id')
            ->add('name', fn ($row) => $row->first_name.' '.$row->last_name)
            ->add('case_number');   // Court case number
    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            Column::make('Person Name', 'name')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),
            //TODO: need to hook this up
            Column::make('Case Number', 'case_number')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

        ];
    }
}
