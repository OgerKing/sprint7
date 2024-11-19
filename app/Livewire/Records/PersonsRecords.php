<?php

namespace App\Livewire\Records;

use App\Helpers\TooltipHelper;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Class PersonsRecords
 *
 * This Livewire component manages the display and interaction
 * with the persons' records, including row selection, exporting
 * selected records to CSV, and rendering paginated results.
 */
class PersonsRecords extends Base
{
    /** The array of selected row IDs. */
    public array $selectedRows = [];

    /** The state of the "Select All" checkbox. */
    public bool $selectAll = false;

    protected array $with = [
        'subfile_people.subfile',
        'subfile_people.authorized_agent_person',
        'person_type_subtype',
        'person_email',
        'person_telephone',
        'subfiles',
    ];

    #[On('person-added')]
    public function reloadPersonsTable()
    {
        // Logic to reload data, e.g., resetting query parameters or re-fetching from the database
        $this->resetPage(); // If using pagination
    }

    protected function base(): Builder
    {
        return Person::query();
    }

    protected function subfileRelationship(): string
    {
        return 'subfile_people.subfile';
    }

    /** Toggles the "Select All" checkbox state and selects/deselects all visible rows. */
    public function toggleSelectAllManual(): void
    {
        $visiblePersonIds = $this->getVisiblePersonIds();

        if ($this->selectAll) {
            $this->selectedRows = [];
        } else {
            $this->selectedRows = $visiblePersonIds;
        }

        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Retrieves the IDs of all persons visible on the current page.
     *
     * @return array The array of visible person IDs.
     */
    protected function getVisiblePersonIds()
    {
        return Person::with([
            'subfile_people.subfile',
            'subfile_people.authorized_agent_person',
            'person_type_subtype',
            'person_email',
            'person_telephone',
            'subfiles',
        ])->paginate(10)->pluck('id')->toArray();
    }

    /**
     * Truncates a given string to the specified length.
     *
     * @param  string  $text  The text to be truncated.
     * @param  int  $limit  The maximum length of the truncated text.
     * @return string The truncated text.
     */
    protected function truncateText(string $text, int $limit = 21): string
    {
        return strlen($text) > $limit ? substr($text, 0, $limit).'...' : $text;
    }

    /**
     * Generates a tooltip for the subfiles associated with a person.
     *
     * @param  Person  $person  The person model instance.
     * @return string The HTML for the subfile tooltip.
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
     * Generates a tooltip for the authorized agents associated with a person.
     *
     * @param  Person  $person  The person model instance.
     * @return string The HTML for the authorized agents tooltip.
     */
    protected function generateAuthorizedAgentsTooltip(Person $person): string
    {
        $authorizedAgents = $person->subfile_people->map(function ($subfilePerson) {
            if ($subfilePerson->authorized_agent_person) {
                return "{$subfilePerson->authorized_agent_person->first_name} {$subfilePerson->authorized_agent_person->last_name}";
            }

            return null;
        })->filter()->unique()->toArray();

        if (empty($authorizedAgents)) {
            return 'N/A';
        }

        return TooltipHelper::generateTooltip($authorizedAgents[0], array_slice($authorizedAgents, 1));
    }

    /**
     * Clears the selected row IDs.
     *
     * @return void
     */
    public function clearSelectedRows()
    {
        $this->selectedRows = [];
    }

    /**
     * Exports selected records to a CSV file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse The file download response.
     */
    public function exportToCsv()
    {
        $persons = Person::whereIn('id', $this->selectedRows)->with([
            'subfile_people.subfile',
            'subfile_people.authorized_agent_person',
            'person_type_subtype',
            'person_email',
            'person_telephone',
            'subfiles',
        ])->get();

        $personsForExport = $persons->map(function ($person) {
            return [
                'Name' => "{$person->last_name}, {$person->first_name}",
                'Person Type' => $person->person_type_subtype->person_type_subtype_name ?? 'N/A',
                'Email' => $person->person_email->primary_contact_email ?? 'N/A',
                'Phone Number' => $person->person_telephone->primary_person_telephone_anumber ?? 'N/A',
                'Subfile(s)' => $this->formatSubfiles($person),
                'Authorized Agent(s)' => $this->formatAuthorizedAgents($person),
                'Updated' => $person->updated_at ? $person->updated_at->format('m/d/Y') : 'N/A',
            ];
        });

        $fileName = 'exported_persons.csv';
        (new FastExcel($personsForExport))->export(storage_path('app/public/'.$fileName));

        return response()->download(storage_path('app/public/'.$fileName))->deleteFileAfterSend(true);
    }

    /**
     * Formats the subfiles associated with a person for CSV export.
     *
     * @param  Person  $person  The person model instance.
     * @return string A comma-separated string of subfile information.
     */
    protected function formatSubfiles(Person $person): string
    {
        $subfiles = $person->subfiles;
        if ($subfiles->isEmpty()) {
            return '--';
        }

        $firstSubfileText = strtoupper($subfiles->first()->basin_section_hl.'-'.$subfiles->first()->sub_file_hl_txt);
        $remainingSubfiles = $subfiles->slice(1)->map(fn ($subfile) => strtoupper($subfile->basin_section_hl.'-'.$subfile->sub_file_hl_txt))->toArray();

        return implode(', ', array_merge([$firstSubfileText], $remainingSubfiles));
    }

    /**
     * Formats the authorized agents associated with a person for CSV export.
     *
     * @param  Person  $person  The person model instance.
     * @return string A comma-separated string of authorized agent names.
     */
    protected function formatAuthorizedAgents(Person $person): string
    {
        $authorizedAgents = $person->subfile_people->map(function ($subfilePerson) {
            if ($subfilePerson->authorized_agent_person) {
                return "{$subfilePerson->authorized_agent_person->first_name} {$subfilePerson->authorized_agent_person->last_name}";
            }

            return null;
        })->filter()->unique()->toArray();

        if (empty($authorizedAgents)) {
            return 'N/A';
        }

        return implode(', ', $authorizedAgents);
    }

    /**
     * Retrieves the full persons objects for the selected rows.
     *
     * This computed property fetches all persons objects that correspond to
     * the IDs stored in $selectedRows, allowing access to the full details
     * of each selected person.
     */
    public function getSelectedPersonsProperty(): Collection
    {
        return $this->fetchSelectedPersons();
    }

    /**
     * Fetches the selected persons.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchSelectedPersons()
    {
        $persons = Person::whereIn('id', $this->selectedRows)->with([
            'subfile_people.subfile',
            'subfile_people.authorized_agent_person',
            'person_type_subtype',
            'person_email',
            'person_telephone',
            'subfiles',
        ])->get();
    }
}
