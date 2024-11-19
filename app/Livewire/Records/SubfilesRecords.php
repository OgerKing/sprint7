<?php

namespace App\Livewire\Records;

use App\Helpers\TooltipHelper;
use App\Models\Attorney;
use App\Models\Subfile;
use App\Models\SubfileAdjudicationStatus;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class SubfilesRecords extends Base
{
    public $selectedRows = [];

    public $selectAll = false;

    //variables for status bulk actions
    public array $subfileStatusOptions = [];

    public array $subfileAttorneyOptions = [];

    public $selectedSubfileStatusForBulkAction = null;

    public $selectedSubfileAttorneyForBulkAction = null;

    protected function base(): Builder
    {
        return Subfile::query();
    }

    protected function subfileRelationship(): string
    {
        return '';
    }

    /**
     * Initializes component state when the component is mounted.
     *
     * This method is called automatically by Livewire when the component is first rendered,
     * and it loads the subfile status options for the dropdown.
     */
    public function mount(): void
    {
        $this->loadSubfileStatusOptions();
        $this->loadSubfileAttorneyOptions();
    }

    /**
     * Loads available subfile status options for the dropdown selection.
     *
     * Retrieves all subfile adjudication statuses from the database, formats them as an array
     * with 'label' and 'value' keys, and assigns them to the $subfileStatusOptions property
     * for display in the dropdown.
     */
    public function loadSubfileStatusOptions(): void
    {
        $subfileAdjudicationStatuses = SubfileAdjudicationStatus::get();

        $subfileAdjudicationStatusOptions = [];
        foreach ($subfileAdjudicationStatuses as $status) {
            $subfileAdjudicationStatusOptions[] = [
                'label' => $status->subfile_adjudication_status_description,
                'value' => $status->id,
            ];
        }

        $this->subfileStatusOptions = $subfileAdjudicationStatusOptions;
    }

    /**
     * Loads available attorney options for the dropdown selection.
     *
     * Retrieves all attorneys from the database, formats them as an array
     * with 'label' and 'value' keys, and assigns them to the $subfileAttorneyOptions property
     * for display in the dropdown.
     */
    public function loadSubfileAttorneyOptions(): void
    {
        $subfileAttorneys = Attorney::all();

        $subfileAttorneyOptions = [];
        foreach ($subfileAttorneys as $attorney) {
            $subfileAttorneyOptions[] = [
                'label' => $attorney->last_name,
                'value' => $attorney->id,
            ];
        }

        $this->subfileAttorneyOptions = $subfileAttorneyOptions;
    }

    /**
     * Retrieves the full subfile objects for the selected rows.
     *
     * This computed property fetches all subfile objects that correspond to
     * the IDs stored in $selectedRows, allowing access to the full details
     * of each selected subfile.
     */
    public function getSelectedSubfilesProperty(): Collection
    {
        return $this->fetchSelectedSubfiles();
    }

    /**
     * Toggles selection of all visible subfiles.
     */
    public function toggleSelectAllManual(): void
    {
        $visibleSubfileIds = $this->getVisibleSubfileIds();

        if ($this->selectAll) {
            $this->selectedRows = [];
        } else {
            $this->selectedRows = $visibleSubfileIds;
        }

        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Returns IDs of all subfiles visible on the current page.
     */
    protected function getVisibleSubfileIds(): array
    {
        return $this->querySubfiles()->pluck('id')->toArray();
    }

    /**
     * Fetches paginated subfiles.
     */
    protected function getSubfiles(): LengthAwarePaginator
    {
        return $this->querySubfiles()->paginate(10);
    }

    /**
     * Queries subfiles with necessary relationships.
     */
    protected function querySubfiles(): Builder
    {
        return Subfile::with(['subfile_adjudication_status']);
    }

    /**
     * Formats the Subfile ID.
     */
    public function formatSubfileID(Subfile $subfile): string
    {
        return strtoupper(
            "{$subfile->basin_section_hl}-{$subfile->sub_file_hl_txt}-{$subfile->sub_file_hl_sfx}"
        );
    }

    /**
     * Formats the case numbers with a tooltip or as a plain string.
     */
    public function formatCaseNumber(Subfile $subfile): string
    {
        $courtCases = $subfile->subfile_court_cases()->orderBy('case_number', 'asc')->get();
        $firstCase = $courtCases->first();

        if (! $firstCase || is_null($firstCase->case_number)) {
            return '--';
        }

        $caseDisplay = strtoupper($firstCase->case_number);

        if ($courtCases->count() > 1) {
            $remainingCases = $courtCases->slice(1)
                ->map(fn ($case) => strtoupper($case->case_number))
                ->toArray();

            return TooltipHelper::generateTooltip($caseDisplay, $remainingCases);
        }

        return $caseDisplay;
    }

    /**
     * Formats the case numbers for CSV export (comma-separated).
     */
    public function formatCaseNumberForCsv(Subfile $subfile): string
    {
        $courtCases = $subfile->subfile_court_cases()->orderBy('case_number', 'asc')->get();

        if ($courtCases->isEmpty()) {
            return '--';
        }

        return $courtCases->pluck('case_number')->filter()->implode(', ');
    }

    /**
     * Truncates the status text with a badge and tooltip if necessary.
     */
    public function truncateStatus(?Subfile $subfile, int $limit = 24): string
    {
        $status = $subfile->subfile_adjudication_status->subfile_adjudication_status_description ?? null;

        if (is_null($status)) {
            return '--';
        }

        $truncatedStatus = Str::limit($status, $limit, '...');

        if (Str::length($status) > $limit) {
            $tooltip = TooltipHelper::generateSingleItemTooltip($truncatedStatus, $status);

            return "<span class='badge badge-bluebubble'>{$tooltip}</span>";
        }

        return "<span class='badge badge-bluebubble'>{$truncatedStatus}</span>";
    }

    /**
     * Formats the active persons with a tooltip or as a plain string.
     */
    public function formatActivePersons(Subfile $subfile): string
    {
        $activePersons = $subfile->activePersons()->get();
        $firstPerson = $activePersons->first();

        if (! $firstPerson) {
            return 'N/A';
        }

        $personDisplay = $firstPerson->first_name.' '.$firstPerson->last_name;

        if ($activePersons->count() > 1) {
            $remainingPersons = $activePersons->slice(1)
                ->map(fn ($person) => "{$person->first_name} {$person->last_name}")
                ->toArray();

            return TooltipHelper::generateTooltip($personDisplay, $remainingPersons);
        }

        return $personDisplay;
    }

    /**
     * Formats the county for the given subfile.
     */
    protected function formatCounty(Subfile $subfile): string
    {
        return $subfile->county_name ?? 'TBD';
    }

    /**
     * Formats active persons for CSV export (comma-separated).
     */
    public function formatActivePersonsForCsv(Subfile $subfile): string
    {
        $activePersons = $subfile->activePersons()->get();

        if ($activePersons->isEmpty()) {
            return 'N/A';
        }

        return $activePersons->map(fn ($person) => "{$person->first_name} {$person->last_name}")
            ->implode(', ');
    }

    /**
     * Formats the start date.
     */
    public function formatStartDate(?string $date): string
    {
        return $date ? Carbon::parse($date)->format('m/d/Y') : '--';
    }

    /**
     * Formats the updated date.
     */
    public function formatUpdatedDate(?string $date): string
    {
        return $date ? Carbon::parse($date)->format('m/d/Y') : '--';
    }

    /**
     * Exports selected subfiles to CSV.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToCsv()
    {
        $subfiles = $this->fetchSelectedSubfiles();
        $formattedSubfiles = $this->prepareSubfilesForExport($subfiles);
        $fileName = $this->generateCsvFile($formattedSubfiles);

        return $this->downloadCsvFile($fileName);
    }

    /**
     * Fetches the selected subfiles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function fetchSelectedSubfiles()
    {
        return Subfile::with(['subfile_adjudication_status', 'attorney'])->whereIn('id', $this->selectedRows)->get();
    }

    /**
     * Prepares subfiles for export to CSV.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $subfiles
     * @return \Illuminate\Support\Collection
     */
    protected function prepareSubfilesForExport($subfiles)
    {
        return $subfiles->map(function ($subfile) {
            return [
                'Subfile ID' => $this->formatSubfileID($subfile),
                'Case Number' => $this->formatCaseNumberForCsv($subfile),
                'Active Persons' => $this->formatActivePersonsForCsv($subfile),
                'Status' => $subfile->subfile_adjudication_status->subfile_adjudication_status_description ?? 'N/A',
                'County' => $this->formatCounty($subfile), // Use the new formatCounty method
                'Start Date' => $this->formatStartDate($subfile->sub_file_start_date),
                'Updated At' => $this->formatUpdatedDate($subfile->updated_at),
            ];
        });
    }

    /**
     * Generates a CSV file from the prepared data.
     *
     * @param  \Illuminate\Support\Collection  $formattedSubfiles
     * @return string
     */
    protected function generateCsvFile($formattedSubfiles)
    {
        $fileName = 'exported_subfiles.csv';
        (new FastExcel($formattedSubfiles))->export(storage_path('app/public/'.$fileName));

        return $fileName;
    }

    /**
     * Downloads the generated CSV file.
     *
     * @param  string  $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function downloadCsvFile($fileName)
    {
        return response()->download(storage_path('app/public/'.$fileName))->deleteFileAfterSend(true);
    }

    // BULK ACTIONS

    //CHANGE STATUS
    /**
     * Saves the selected subfile status for all selected subfiles in bulk.
     *
     * This method takes the selected subfile status ID from the $selectedSubfileStatusForBulkAction property
     * and applies it to each subfile in $selectedRows by updating their subfile_adjudication_status_id.
     * After updating, it dispatches success messages to the user and hides the modal.
     *
     * @return void
     */
    public function saveSubfileStatusBulkAction()
    {
        $statusId = $this->selectedSubfileStatusForBulkAction; // The selected status ID

        // Update the status for each selected subfile
        Subfile::whereIn('id', $this->selectedRows) // Assuming $selectedRows holds the IDs of selected subfiles
            ->update(['subfile_adjudication_status_id' => $statusId]);

        // dispatch a success message and hide the modal
        session()->flash('success', 'Status saved to subfiles');
        $this->dispatch('flashMessage', session('success'), 'success');
        $this->dispatch('hide-subfile-status-bulk-action-modal');
        $this->selectedSubfileStatusForBulkAction = null;
    }

    //CHANGE ATTORNEY
    /**
     * Saves the selected subfile attorney for all selected subfiles in bulk.
     *
     * This method takes the selected attorneyid from the $selectedSubfileAttorneyForBulkAction property
     * and applies it to each subfile in $selectedRows by updating their sub_file_assigned_ose_attorney_person_id
     * After updating, it dispatches success messages to the user and hides the modal.
     *
     * @return void
     */
    public function saveSubfileAttorneyBulkAction()
    {
        $attorneyId = $this->selectedSubfileAttorneyForBulkAction; // The selected attorney ID

        // Update the attorney for each selected subfile
        Subfile::whereIn('id', $this->selectedRows)
            ->update(['sub_file_assigned_ose_attorney_person_id' => $attorneyId]);

        // dispatch a success message and hide the modal
        session()->flash('success', 'Attorney saved to subfiles');
        $this->dispatch('flashMessage', session('success'), 'success');
        $this->dispatch('hide-subfile-attorney-bulk-action-modal');
        $this->selectedSubfileAttorneyForBulkAction = null;
    }

    //ADD/REMOVE WATCHER
    /**
     * Adds selected subfiles to the user's watch list if they are not already present.
     */
    public function subfileAddWatcher(): void
    {
        $user = auth()->user(); // Get the currently authenticated user

        // Use `syncWithoutDetaching` with additional attributes
        $user->watchedSubfiles()->syncWithoutDetaching(
            collect($this->selectedRows)->mapWithKeys(function ($subfileId) use ($user) {
                return [
                    $subfileId => [
                        'created_by' => $user->id,  // Add created_by as the user's ID
                        'updated_by' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];
            })->toArray()
        );
        session()->flash('success', 'Watch status has been updated on subfiles');
        $this->dispatch('flashMessage', session('success'), 'success');
        $this->dispatch('hide-subfile-watch-modal');
    }

    /**
     * Removes selected subfiles from the user's watch list if they are present.
     */
    public function subfileRemoveWatcher(): void
    {
        $user = auth()->user(); // Get the currently authenticated user

        // Detach the selected subfiles from the user's watch list
        $user->watchedSubfiles()->detach($this->selectedRows);

        $this->dispatch('hide-subfile-watch-modal');
    }

    /**
     * Close bulk action modals
     */
    public function cancelAndCloseModals(): void
    {
        $this->dispatch('hide-subfile-watch-modal');
        $this->dispatch('hide-subfile-status-bulk-action-modal');
    }
}
