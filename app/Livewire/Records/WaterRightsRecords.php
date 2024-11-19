<?php

namespace App\Livewire\Records;

use App\Models\WaterRight;
use Illuminate\Database\Eloquent\Builder;
use Rap2hpoutre\FastExcel\FastExcel;

class WaterRightsRecords extends Base
{
    /**
     * The IDs of the selected rows.
     *
     * @var array
     */
    public $selectedRows = [];

    /**
     * Whether to select all rows.
     *
     * @var bool
     */
    public $selectAll = false;

    /**
     * Filter for subfile.
     *
     * @var mixed
     */
    public $subfileFilter = null;

    /**
     * Filter for POD.
     *
     * @var mixed
     */
    public $podFilter = null;

    protected function base(): Builder
    {
        return WaterRight::query();
    }

    protected function subfileRelationship(): string
    {
        return 'subfile';
    }

    /**
     * Toggles selection of all visible water rights.
     */
    public function toggleSelectAllManual(): void
    {
        $visibleWaterRightIds = $this->getVisibleWaterRightIds();

        if ($this->selectAll) {
            $this->selectedRows = [];
        } else {
            $this->selectedRows = $visibleWaterRightIds;
        }

        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Retrieves visible water rights IDs based on current filters.
     *
     * @return array
     */
    protected function getVisibleWaterRightIds()
    {
        return $this->queryWaterRights()->pluck('id')->toArray();
    }

    /**
     * Fetches paginated water rights data with applied filters.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getWaterRights()
    {
        return $this->queryWaterRights()->paginate(10);
    }

    /**
     * Builds the query for fetching water rights with filters.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryWaterRights()
    {
        return WaterRight::with(['subfile', 'pods', 'pou_water_rights', 'pod_water_rights'])
            ->when($this->subfileFilter, fn ($query) => $query->where('subfile_id', $this->subfileFilter))
            ->when($this->podFilter, fn ($query) => $query->whereRelation('pods', 'id', $this->podFilter));
    }

    /**
     * Formats the Water Right ID.
     */
    protected function formatRightID(WaterRight $waterRight): string
    {
        return $waterRight->formatRightID();
    }

    /**
     * Truncates the purpose text for the water right.
     */
    protected function truncateText(WaterRight $waterRight): string
    {
        return $waterRight->truncatePurpose();
    }

    /**
     * Formats the subfile details for the water right.
     */
    protected function formatSubfileDetails(WaterRight $waterRight): string
    {
        return $waterRight->formatSubfileDetails();
    }

    /**
     * Formats the active persons for the water right.
     */
    protected function formatActivePersons(WaterRight $waterRight): string
    {
        return $waterRight->formatActivePersons();
    }

    /**
     * Clears the list of selected rows.
     *
     * @return void
     */
    public function clearSelectedRows()
    {
        $this->selectedRows = [];
    }

    /**
     * Exports selected water rights to a CSV file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToCsv()
    {
        $waterRights = $this->fetchSelectedWaterRights();

        $formattedWaterRights = $this->prepareWaterRightsForExport($waterRights);

        $fileName = $this->generateCsvFile($formattedWaterRights);

        return $this->downloadCsvFile($fileName);
    }

    /**
     * Retrieves the full water rights objects for the selected rows.
     *
     * This computed property fetches all water rights objects that correspond to
     * the IDs stored in $selectedRows, allowing access to the full details
     * of each selected water right.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    #[Computed]
    public function getSelectedWaterRightsProperty()
    {
        return $this->fetchSelectedWaterRights();
    }

    /**
     * Fetches selected water rights along with their related data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function fetchSelectedWaterRights()
    {
        return WaterRight::whereIn('id', $this->selectedRows)
            ->with([
                'subfile',
                'pods',
                'pou_water_rights',
                'pod_water_rights',
                'activePersons',
            ])
            ->get();
    }

    /**
     * Prepares the water rights data for CSV export.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $waterRights
     * @return \Illuminate\Support\Collection
     */
    protected function prepareWaterRightsForExport($waterRights)
    {
        return $waterRights->map(function ($waterRight) {
            $activePersons = $waterRight->activePersons->map(fn ($person) => $person->first_name.' '.$person->last_name)->implode(', ');

            return [
                'Right ID' => $this->formatRightID($waterRight),
                'Subfile/Header' => $this->formatSubfileDetails($waterRight),
                'Purpose' => $waterRight->purpose_txt ?? 'N/A',
                'Active Persons' => $activePersons ?: 'N/A',
                'HS Work Status' => $waterRight->right_status_id ?? 'N/A',
                'Priority Date' => $waterRight->pod_water_rights->isNotEmpty()
                    ? $waterRight->pod_water_rights->first()->priority_date->format('m/d/Y')
                    : 'N/A',
                'Updated' => $waterRight->updated_at ? $waterRight->updated_at->format('m/d/Y') : 'N/A',
            ];
        });
    }

    /**
     * Generates and stores a CSV file from the given water rights data.
     *
     * @param  \Illuminate\Support\Collection  $formattedWaterRights
     * @return string The file name of the generated CSV.
     */
    protected function generateCsvFile($formattedWaterRights)
    {
        $fileName = 'exported_water_rights.csv';
        (new FastExcel($formattedWaterRights))->export(storage_path('app/public/'.$fileName));

        return $fileName;
    }

    /**
     * Provides a response to download the CSV file and deletes it after sending.
     *
     * @param  string  $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function downloadCsvFile($fileName)
    {
        return response()->download(storage_path('app/public/'.$fileName))->deleteFileAfterSend(true);
    }
}
