<?php

namespace App\Livewire\Records;

use App\Helpers\TooltipHelper;
use App\Models\Pod;
use App\Models\WaterRight;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Rap2hpoutre\FastExcel\FastExcel;

class PointsOfDiversionRecords extends Base
{
    public $selectedRows = [];

    public $selectAll = false;

    //Add to Right
    public $waterRightsOptions = [];

    public $selectedWaterRightForBulkAction = null;

    protected function base(): Builder
    {
        return Pod::query();
    }

    protected function subfileRelationship(): string
    {
        return 'water_rights.subfile';
    }

    /**
     * Initializes component state when the component is mounted.
     *
     * This method is called automatically by Livewire when the component is first rendered,
     * and it loads the water rights options for the dropdown.
     */
    public function mount(): void
    {
        $this->loadWaterRightsOptions();
    }

    /**
     * Loads available subfile status options for the dropdown selection.
     *
     * Retrieves all subfile adjudication statuses from the database, formats them as an array
     * with 'label' and 'value' keys, and assigns them to the $subfileStatusOptions property
     * for display in the dropdown.
     *
     * @return void
     */
    public function loadWaterRightsOptions()
    {
        $waterRights = WaterRight::get();

        $waterRightsOptions = [];
        foreach ($waterRights as $right) {
            $waterRightsOptions[] = [
                'label' => $right->id,
                'value' => $right->id,
            ];
        }

        $this->waterRightsOptions = $waterRightsOptions;
    }

    /**
     * Toggle selection of all visible rows.
     *
     * @return void
     */
    public function toggleSelectAllManual()
    {
        $this->selectedRows = $this->selectAll ? [] : $this->getVisiblePodIds();
        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Get IDs of all visible Points of Diversion.
     *
     * @return array
     */
    protected function getVisiblePodIds()
    {
        return $this->queryPods()->pluck('id')->toArray();
    }

    /**
     * Fetch paginated Points of Diversion.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getPods()
    {
        return $this->queryPods()->paginate(10);
    }

    /**
     * Define the Points of Diversion query with relationships.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryPods()
    {
        return Pod::with([
            'water_rights.water_source',
            'county',
        ]);
    }

    /**
     * Format the SID value.
     */
    public function formatSid(Pod $pod): string
    {
        return $pod->s_id_access ?? 'N/A';
    }

    /**
     * Format the OSE File Number.
     */
    public function formatOseFile(Pod $pod): string
    {
        return $pod->ose_file ?? 'N/A';
    }

    /**
     * Format the Subfiles with a tooltip for extra subfiles.
     */
    public function formatSubfiles(Pod $pod): string
    {
        $subfiles = $pod->water_rights->map->formatSubfileDetails();
        $firstSubfile = $subfiles->first();

        if (! $firstSubfile || $firstSubfile === 'N/A') {
            return 'N/A';
        }

        if ($subfiles->count() > 1) {
            $remainingSubfiles = $subfiles->slice(1)->toArray();

            return TooltipHelper::generateTooltip($firstSubfile, $remainingSubfiles);
        }

        return $firstSubfile;
    }

    /**
     * Get the count of Subfiles.
     */
    public function getSubfilesCount(Pod $pod): int
    {
        return $pod->subfile_pod_right ? $pod->subfile_pod_right->count() : 0;
    }

    /**
     * Format the Section.
     */
    public function formatSection(Pod $pod): string
    {
        return $pod->section ?? 'N/A';
    }

    /**
     * Format the County name.
     */
    public function formatCounty(Pod $pod): string
    {
        return 'TBD';

        return $pod->county->county_name ?? $pod->pou_irrigations->first()?->county->county_name ?? 'N/A';
    }

    /**
     * Format the Updated date.
     */
    public function formatUpdatedDate(Pod $pod): string
    {
        return optional($pod->updated_at)->format('m/d/Y') ?? '--';
    }

    /**
     * Format the Water Source description.
     */
    public function formatWaterSource(Pod $pod): string
    {
        return $pod->water_rights->first()?->water_source->water_source_description ?? 'N/A';
    }

    /**
     * Format the POD Number.
     */
    public function formatPodNumber(Pod $pod): string
    {
        return $pod->waters_pod_id ?? 'N/A';
    }

    /**
     * Export selected records to CSV.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToCsv()
    {
        $pods = $this->fetchSelectedPods();
        $formattedData = $this->preparePodsForExport($pods);
        $fileName = $this->generateCsvFile($formattedData);

        return $this->downloadCsvFile($fileName);
    }

    /**
     * Fetch selected POD records for export.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function fetchSelectedPods()
    {
        return Pod::whereIn('id', $this->selectedRows)->get();
    }

    /**
     * Prepare data for CSV export.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $pods
     * @return \Illuminate\Support\Collection
     */
    protected function preparePodsForExport($pods)
    {
        return $pods->map(function ($pod) {
            return [
                'SID' => $this->formatSid($pod),
                'OSE File No' => $this->formatOseFile($pod),
                'Subfile(s)' => strip_tags($this->formatSubfiles($pod)), // Remove HTML from tooltip for CSV
                'Subfiles Count' => $this->getSubfilesCount($pod),
                'Section' => $this->formatSection($pod),
                'County' => $this->formatCounty($pod),
                'Updated' => $this->formatUpdatedDate($pod),
                'POD Source Origin' => $this->formatWaterSource($pod),
                'POD #' => $this->formatPodNumber($pod),
            ];
        });
    }

    /**
     * Generate CSV file and return file name.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @return string
     */
    protected function generateCsvFile($data)
    {
        $fileName = 'exported_points_of_diversion.csv';
        (new FastExcel($data))->export(storage_path("app/public/{$fileName}"));

        return $fileName;
    }

    /**
     * Download CSV file response and delete after sending.
     *
     * @param  string  $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function downloadCsvFile($fileName)
    {
        return response()->download(storage_path("app/public/{$fileName}"))->deleteFileAfterSend(true);
    }

    /**
     * Retrieves the full pod objects for the selected rows.
     *
     * This computed property fetches all pod objects that correspond to
     * the IDs stored in $selectedRows, allowing access to the full details
     * of each selected pod
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    #[Computed]
    public function getSelectedPointsOfDiversionProperty()
    {
        return $this->fetchSelectedPods();
    }

    /**
     * Bulk assigns selected Points of Diversion (PODs) to a specified Water Right.
     *
     * This method associates each selected POD, identified in `selectedRows`, with a specific Water Right
     * determined by `selectedWaterRightForBulkAction`. If an association between a POD and the Water Right
     * already exists, it is not modified; otherwise, it is created with additional attributes such as
     * `created_by`, `updated_by`, `created_at`, `updated_at`, `acres_pri`, `acre_ft_pri`, and `percent_cfs`.
     *
     * - `created_by` and `updated_by` are set to the currently authenticated user's ID.
     * - `acres_pri`, `acre_ft_pri`, and `percent_cfs` are defaulted to placeholder values for this operation.
     *
     * After successful assignment, a success message is flashed to the session, a modal is closed,
     * and the `selectedWaterRightForBulkAction` property is reset.
     *
     * @return void
     */
    public function savePodWaterRightBulkAction()
    {
        $waterRightId = $this->selectedWaterRightForBulkAction;

        $waterRight = WaterRight::find($waterRightId);

        // Attach the water right to the pod, if not already attached, with additional attributes
        $waterRight->pods()->syncWithoutDetaching(
            collect($this->selectedRows)->mapWithKeys(function ($podId) {
                $user = auth()->user(); // Get the currently authenticated user

                return [
                    $podId => [
                        'created_at' => now(),
                        'updated_at' => now(),
                        'created_by' => $user->id,  // Add created_by as the user's ID
                        'updated_by' => $user->id,
                        'acres_pri' => 0.1, //not nullable and no default //TODO:
                        'acre_ft_pri' => .1, //not nullable and no default //TODO:
                        'percent_cfs' => 0.1, //not nullable and no default //TODO:
                    ],
                ];
            })->toArray()
        );

        // Success message and close modal
        session()->flash('success', 'PODs successfully assigned to the water right.');
        $this->dispatch('flashMessage', session('success'), 'success');
        $this->cancelAndCloseModals();
        $this->selectedWaterRightForBulkAction = null;
    }

    /**
     * Close bulk action modals
     *
     * @return void
     */
    public function cancelAndCloseModals()
    {
        $this->dispatch('hide-pod-water-rights-bulk-action-modal');
    }
}
