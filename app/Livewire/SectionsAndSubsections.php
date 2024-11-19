<?php

namespace App\Livewire;

use App\Models\AdjudicationSection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class SectionsAndSubsections extends PowerGridComponent
{
    use WithExport;

    public $adjudication_id;

    protected $listeners = ['refreshSectionsList'];

    public function setUp(): array
    {

        return [
            //Detail is where the subsections are displayed. Detail code can be found in livewire.sections-row-detail
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Detail::make()
                ->view('livewire.sections-row-detail')
                ->showCollapseIcon()
                ->collapseOthers(),

        ];
    }

    public function actionRules(): array
    {

        //Add conditional classes. Disable the ability to open the detail expansion if there are no subsections.
        return [
            Rule::rows()
                ->setAttribute('class', 'detail-rows'),
            Rule::rows()
                ->when(function ($row) {
                    $isEmpty = $row->subsections->isEmpty();

                    return $isEmpty;
                })
                ->setAttribute('class', 'disable-toggle'),
        ];
    }

    public function datasource(): Builder
    {
        return AdjudicationSection::query()
            ->with('subsections.childSection', 'adjudication_section_type', 'adjudication_section_status')
            ->where('adjudication_id', $this->adjudication_id)
            ->where(function ($query) {
                //Includes sections that are parents by checking if their ID exists as a parent in the adjudication_subsections table
                $query->whereIn('id', function ($subQuery) {
                    $subQuery->select('parent_adjudication_subsection_id')
                        ->from('adjudication_subsections');
                })
                    //excludes sections that are children by checking if their ID exists as a child in the adjudication_subsections table.
                    ->orWhereNotIn('id', function ($subQuery) {
                        $subQuery->select('child_adjudication_subsection_id')
                            ->from('adjudication_subsections');
                    });
            })
            ->orderBy('adjudication_section_name', 'asc'); // Order by adjudication_section_name in ascending order;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('adjudication_section_name')
            ->add('prefix')
            ->add('maps', function ($map) {
                return '008, 009'; //TODO: hard coded at the moment -MA
            })
            ->add('adjudication_section_type', function ($section) {
                return $section->adjudication_section_type->adjudication_section_type_code;
            })
            ->add('adjudication_section_status', function ($section) {
                return $section->adjudication_section_status->adjudication_section_status_description;
            })
            ->add('boundary_name');
    }

    public function columns(): array
    {
        return [
            Column::make('Section Id', 'id')
                ->headerAttribute('wrats-custom-column width-80')
                ->bodyAttribute('sas-body-class width-80'),
            Column::make('Section Name', 'adjudication_section_name')
                ->sortable()
                ->searchable()
                ->headerAttribute('wrats-custom-column width-230')
                ->bodyAttribute('sas-body-class width-230'),
            Column::make('Prefix', 'prefix')
                // ->sortable()
                ->searchable()
                ->headerAttribute('wrats-custom-column width-150')
                ->bodyAttribute('sas-body-class width-150'),
            Column::make('Section Types', 'adjudication_section_type')
                // ->sortable()
                ->searchable()
                ->headerAttribute('wrats-custom-column width-150')
                ->bodyAttribute('sas-body-class width-150'),
            Column::make('Section Status', 'adjudication_section_status')
                ->headerAttribute('wrats-custom-column width-150')
                ->bodyAttribute('sas-body-class width-150'),
            Column::make('Map(s)', 'maps') //TODO: these are hardcoded at the moment -MA
                ->headerAttribute('wrats-custom-column width-150')
                ->bodyAttribute('sas-body-class width-150'),
            Column::make('Hydro Boundary', 'boundary_name')
                // ->sortable()
                ->searchable()
                ->headerAttribute('wrats-custom-column width-200')
                ->bodyAttribute('sas-body-class width-200'),
            Column::action('')
                ->headerAttribute('wrats-custom-column width-100')
                ->bodyAttribute('sas-body-class width-100'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //Listener in UpdateSectionForm.php
        $this->dispatch('setEditSectionId', $rowId);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        abort_unless(auth()->user()->can('add or edit adjudication sections'), 400);

        AdjudicationSection::findOrFail($rowId)->delete();
    }

    public function refreshSectionsList()
    {
        // Refresh the component to reload the data
        $this->dispatch('$refresh');
    }

    public function actions(AdjudicationSection $row): array
    {
        return [
            Button::add('custom')
                ->render(function ($row) {
                    return Blade::render(<<<HTML
                      @can('add or edit adjudication sections')
                <div class="dropdown">

  <i class="bi bi-three-dots-vertical btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item"
                type="button" 
                data-bs-target="#adjudicationSectionsModal"
                data-bs-toggle="modal"
                data-bs-dismiss="modal" 
                wire:click="edit($row->id)">Edit</button></li>
    <li>
        <button
                class="dropdown-item text-danger"
                type="button"
                wire:click="delete($row->id)"
                wire:confirm="Are you sure you want to delete this Adjudication Section?"
        >Delete</button>
    </li>
  </ul>
</div>
@endcan
HTML);
                }),

        ];
    }
}
