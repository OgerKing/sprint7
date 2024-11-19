<?php

namespace App\Livewire\Records;

use App\Helpers\TooltipHelper;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Class AuthorizedAgentsRecords
 *
 * This Livewire component handles the display and interaction with authorized agents,
 * including pagination, selection, and export functionalities.
 */
class AuthorizedAgentsRecords extends Base
{
    use WithPagination;

    /**
     * Array of selected row IDs.
     */
    public array $selectedRows = [];

    /**
     * Tracks the state of the "Select All" checkbox.
     */
    public bool $selectAll = false;

    protected function base(): Builder
    {
        return Person::query()
            ->whereRelation('subfile_people', 'is_authorized_agent', '>', 0);
    }

    protected function subfileRelationship(): string
    {
        return 'subfile_people.subfile';
    }

    protected array $with = [
        'subfile_people.subfile',
        'person_type_subtype',
        'person_email',
        'person_telephone',
        'subfiles',
    ];

    /**
     * Toggles the "Select All" checkbox state and updates the selected rows.
     */
    public function toggleSelectAllManual(): void
    {
        $visiblePersonIds = $this->getVisiblePersonIds();

        $this->selectedRows = $this->selectAll ? [] : $visiblePersonIds;
        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Retrieves the IDs of visible authorized agents on the current page.
     */
    protected function getVisiblePersonIds(): array
    {
        return $this
            ->base()
            ->paginate(self::PER_PAGE)
            ->pluck('id')
            ->all();
    }

    /**
     * Truncates a given text to a specified length.
     */
    protected function truncateText(string $text, int $limit = 21): string
    {
        return strlen($text) > $limit ? substr($text, 0, $limit).'...' : $text;
    }

    /**
     * Generates a tooltip for the subfiles associated with a person.
     */
    protected function generateSubfileTooltip(Person $person): string
    {
        $subfiles = $person->subfiles;
        $firstSubfile = $subfiles->first();

        if (! $firstSubfile) {
            return '--';
        }

        $firstSubfileText = strtoupper($firstSubfile->basin_section_hl.'-'.$firstSubfile->sub_file_hl_txt);
        $remainingSubfiles = $subfiles->slice(1)->map(fn ($subfile) => strtoupper($subfile->basin_section_hl.'-'.$subfile->sub_file_hl_txt))->toArray();

        return TooltipHelper::generateTooltip($firstSubfileText, $remainingSubfiles);
    }

    /**
     * Retrieves a formatted string of persons represented by an authorized agent.
     */
    protected function getPersonsRepresented(Person $person): string
    {
        $representedPersons = $person->subfile_people
            ->flatMap(fn ($subfilePerson) => optional($subfilePerson->subfile)->subfile_people ?? collect())
            ->filter(fn ($subfilePerson) => $subfilePerson->person_interest_type_id === 1)
            ->map(fn ($subfilePerson) => "{$subfilePerson->person->last_name} {$subfilePerson->person->first_name}")
            ->unique()
            ->values()
            ->toArray();

        if (empty($representedPersons)) {
            return 'N/A';
        }

        $firstPerson = $representedPersons[0];
        $additionalPersons = array_slice($representedPersons, 1);

        return TooltipHelper::generateTooltip($firstPerson, $additionalPersons);
    }

    /**
     * Clears the selected rows.
     *
     * @return void
     */
    public function clearSelectedRows()
    {
        $this->selectedRows = [];
    }

    /**
     * Exports selected authorized agents to a CSV file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    /**
     * Exports selected authorized agents to a CSV file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToCsv()
    {
        $authorizedAgents = Person::whereIn('id', $this->selectedRows)
            ->whereRelation('subfile_people', 'is_authorized_agent', '>', 0)
            ->with([
                'subfile_people.subfile',
                'person_type_subtype',
                'person_email',
                'person_telephone',
                'subfiles',
            ])->get();

        $agentsForExport = $authorizedAgents->map(function ($agent) {
            return [
                'Name' => "{$agent->last_name}, {$agent->first_name}",
                'Agent Type' => $agent->person_type_subtype->person_type_subtype_name ?? 'N/A',
                'Email' => $agent->person_email->primary_contact_email ?? 'N/A',
                'Phone Number' => $agent->person_telephone->primary_person_telephone_anumber ?? 'N/A',
                'Subfile(s)' => $this->formatSubfilesForCsv($agent), // Updated for CSV output
                'Persons Represented' => $this->formatPersonsRepresentedForCsv($agent), // Updated for CSV output
                'Updated' => $agent->updated_at ? $agent->updated_at->format('m/d/Y') : 'N/A',
            ];
        });

        $fileName = 'exported_authorized_agents.csv';
        (new FastExcel($agentsForExport))->export(storage_path('app/public/'.$fileName));

        return response()->download(storage_path('app/public/'.$fileName))->deleteFileAfterSend(true);
    }

    /**
     * Formats the subfiles associated with a person as a comma-separated string for CSV export.
     */
    protected function formatSubfilesForCsv(Person $person): string
    {
        $subfiles = $person->subfiles;
        if ($subfiles->isEmpty()) {
            return '--';
        }

        $formattedSubfiles = $subfiles->map(fn ($subfile) => strtoupper($subfile->basin_section_hl.'-'.$subfile->sub_file_hl_txt))->toArray();

        return implode(', ', $formattedSubfiles);
    }

    /**
     * Formats the persons represented by the authorized agent as a comma-separated string for CSV export.
     */
    protected function formatPersonsRepresentedForCsv(Person $person): string
    {
        $representedPersons = $person->subfile_people
            ->flatMap(fn ($subfilePerson) => optional($subfilePerson->subfile)->subfile_people ?? collect())
            ->filter(fn ($subfilePerson) => $subfilePerson->person_interest_type_id === 1)
            ->map(fn ($subfilePerson) => "{$subfilePerson->person->last_name} {$subfilePerson->person->first_name}")
            ->unique()
            ->toArray();

        return empty($representedPersons) ? 'N/A' : implode(', ', $representedPersons);
    }
}
