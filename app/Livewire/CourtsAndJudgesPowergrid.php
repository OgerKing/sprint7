<?php

namespace App\Livewire;

use App\Models\Adjudication;
use App\Models\AdjudicationSection;
use App\Models\CourtCase;
use App\Models\CourtCaseAdjudicationSection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CourtsAndJudgesPowergrid extends PowerGridComponent
{
    use WithExport;

    public $adjudication_id;

    public $adjudication;

    public $caj_permissions;

    protected $listeners = ['refreshCourtsList'];

    public function setUp(): array
    {
        return [

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function permissions()
    {
        if ($this->adjudication->adjudication_status->adjudication_status_description === 'Final Decree') {
            $this->caj_permissions = 'sys-admin only';
        }
        // Check if the user has the role 'WRATS_LawClerk'
        elseif (auth()->user()->hasRole('WRATS_LawClerk')) {
            // Check if the user's bureaus contain the adjudication's bureau_id
            $userBureauIds = auth()->user()->bureaus->pluck('id')->toArray();

            if (in_array($this->adjudication->bureau_id, $userBureauIds)) {
                $this->caj_permissions = 'bureau-law-clerk-and-up';
            } else {
                // If the user's bureaus do not match the adjudication's bureau_id
                $this->caj_permissions = 'sys-admin and lap admin only';
            }
        } else {
            $this->caj_permissions = 'sys-admin and lap admin only';
        }
    }

    public function datasource(): Builder
    {
        $this->adjudication = Adjudication::where('id', $this->adjudication_id)->with('adjudication_status')->first();

        $this->permissions();

        // Get Adjudication Sections by adjudication_id
        $adjudicationSections = AdjudicationSection::query()
            ->where('adjudication_id', $this->adjudication_id)
            ->pluck('id'); // Get only the ids of the sections

        // Get CourtCaseAdjudicationSections where adjudication_section_id matches the above.
        $courtCaseAdjudicationSections = CourtCaseAdjudicationSection::query()
            ->whereIn('adjudication_section_id', $adjudicationSections)
            ->pluck('court_case_id'); // Get only the court_case ids

        // Get all court cases associated with the adjudication sections in the last query
        // Join with related tables to enable sorting by court_name
        $courtCases = CourtCase::query()
            ->whereIn('court_cases.id', $courtCaseAdjudicationSections)
            ->join('courts', 'court_cases.court_id', '=', 'courts.id')
            ->leftJoin('court_personnel as judges', 'court_cases.court_judge_id', '=', 'judges.id')
            ->leftJoin('court_personnel as masters', 'court_cases.court_master_id', '=', 'masters.id')
            ->select(
                'court_cases.id as id',
                'court_cases.case_number',
                'court_cases.case_name',
                'courts.court_name',
                'courts.court_jurisdiction',
                'court_cases.court_docket_link',
                'judges.first_name as judge_first_name',
                'judges.last_name as judge_last_name',
                'masters.first_name as master_first_name',
                'masters.last_name as master_last_name'
            )
            ->orderBy('courts.court_name', 'asc'); // Order by court_name in ascending order

        return $courtCases;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('court_name', fn ($courtCase) => $courtCase->court_name)
            ->add('court_jurisdiction', fn ($courtCase) => $courtCase->court_jurisdiction)
            ->add('court_docket_link', fn ($courtCase) => $this->truncateText($courtCase->court_docket_link ? $courtCase->court_docket_link : '', 20))
            ->add('court_judge', fn ($courtCase) => $courtCase->judge_first_name.' '.$courtCase->judge_last_name)
            ->add('court_master', fn ($courtCase) => $courtCase->master_first_name ? $courtCase->master_first_name.' '.$courtCase->master_last_name : 'N/A')
            ->add('case_name', fn ($courtCase) => $this->truncateText($courtCase->case_name ? $courtCase->case_name : '', 20))
            ->add('case_number', fn ($courtCase) => $courtCase->case_number);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Court name', 'court_name')
                // ->sortable()
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Court Jurisdiction', 'court_jurisdiction')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80'),

            Column::make('Docket Link', 'court_docket_link')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Judge', 'court_judge')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Court Master', 'court_master')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Case Name', 'case_name')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::make('Case Number', 'case_number')
                ->searchable()
                ->bodyAttribute('sas-body-class width-80')
                ->headerAttribute('wrats-custom-column width-80'),

            Column::action(''),
        ];
    }

    public function refreshCourtsList()
    {
        // Refresh the component to reload the data
        $this->dispatch('$refresh');
    }

    private function truncateText(string $text, int $length): string
    {
        if (strlen($text) > $length) {
            return substr($text, 0, $length).'...';
        }

        return $text;
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->dispatch('setCourtCaseId', $rowId);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        abort_unless(auth()->user()->can($this->caj_permissions), 400);

        CourtCase::findOrFail($rowId)->delete();
    }

    public function actions(CourtCase $row): array
    {

        return [

            Button::add('custom')
                ->render(function ($row) {
                    $permission = $this->caj_permissions;

                    return Blade::render(<<<HTML
                                    @can('$permission')

                <div class="dropdown">

  <i class="bi bi-three-dots-vertical btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item"
                type="button" 
                data-bs-target="#courtsAndJudgesModal"
                data-bs-toggle="modal"
                data-bs-dismiss="modal" 
                wire:click="edit($row->id)">Edit</button></li>
    <li>
      <button
        class="dropdown-item text-danger"
        type="button"
        wire:click="delete($row->id)"
        wire:confirm="Are you sure you want to delete this Court Case?"
      >Delete</button></li>
  </ul>
</div>
@endcan
HTML);
                }),

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
