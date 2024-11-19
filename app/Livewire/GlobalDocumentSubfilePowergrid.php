<?php

namespace App\Livewire;

use App\Models\GlobalDocumentSubfile;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GlobalDocumentSubfilePowergrid extends PowerGridComponent
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
        return GlobalDocumentSubfile::query()
            ->where('global_document_id', $this->documentId)
            ->join('subfiles', 'global_document_subfiles.subfile_id', '=', 'subfiles.id')
            ->leftJoin('subfile_court_cases', 'subfiles.id', '=', 'subfile_court_cases.subfile_id')
            ->leftJoin('court_cases', 'subfile_court_cases.court_case_id', '=', 'court_cases.id') // Join court_cases table
            ->select(
                'global_document_subfiles.id',
                'global_document_subfiles.subfile_id',
                'subfiles.basin_section_hl',
                'court_cases.case_number',
                'subfiles.sub_file_hl_txt',
                'subfiles.sub_file_hl_sfx'
            );
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('subfile_id_format', fn ($row) => $row->basin_section_hl.'-'.$row->sub_file_hl_txt.'-'.$row->sub_file_hl_sfx)
            ->add('case_number');
        //TODO: need to add Active Persons but missing Subfile Persons seeder/data
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Subfile ID', 'subfile_id_format')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Case Number', 'case_number')
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

        ];
    }
}
