<?php

namespace App\Livewire\Records;

use App\Helpers\TooltipHelper;
use App\Models\Pou;
use App\Models\WaterRight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PlacesOfUseRecords extends Base
{
    public $selectedRows = [];

    public $selectAll = false;

    public array $waterRightsOptions = [];

    public ?int $selectedWaterRightForBulkAction = null;

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

    protected function base(): Builder
    {
        return Pou::query();
    }

    protected function subfileRelationship(): string
    {
        return 'water_rights.subfile';
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
        $waterRights = WaterRight::all();

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
        $this->selectedRows = $this->selectAll ? [] : $this->getVisiblePlaceIds();
        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Get IDs of all visible Places of Use.
     *
     * @return array
     */
    protected function getVisiblePlaceIds()
    {
        return $this->queryPlacesOfUse()->pluck('id')->toArray();
    }

    /**
     * Fetch paginated Places of Use.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getPlacesOfUse()
    {
        return $this->queryPlacesOfUse()->paginate(10);
    }

    /**
     * Define the Places of Use query with relationships.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryPlacesOfUse()
    {
        return Pou::with([
            'pou_irrigations.county',
            'pou_non_irrigations',
            'pou_status',
            'water_rights.subfile.adjudication_section',
        ]);
    }

    /**
     * Format the place type based on irrigation or non-irrigation status.
     */
    public function formatPlaceType(Pou $place): string
    {
        return $place->pou_irrigations->isNotEmpty() ? 'Irrigation' : ($place->pou_non_irrigations->isNotEmpty() ? 'Non-Irrigation' : 'N/A');
    }

    /**
     * Format the acreage of the place.
     */
    public function formatAcres(Pou $place): string
    {
        return $place->rev_hs_acres ?? 'N/A';
    }

    /**
     * Format subfiles with a tooltip for extra subfiles.
     */
    public function formatSubfiles(Pou $place): string
    {
        $subfiles = $place->water_rights->filter(fn ($wr) => $wr->subfile);
        $firstSubfile = $subfiles->first()?->subfile;

        if (! $firstSubfile) {
            return 'N/A';
        }

        $subfileDisplay = strtoupper("{$firstSubfile->basin_section_hl}-{$firstSubfile->sub_file_hl_txt}-{$firstSubfile->subfile_hl_suffix}/".
            ($firstSubfile->hs_doc_heading ?? 'N/A'));

        if ($subfiles->count() > 1) {
            $remainingSubfiles = $subfiles->slice(1)
                ->map(fn ($subfile) => strtoupper("{$subfile->subfile->basin_section_hl}-{$subfile->subfile->sub_file_hl_txt}-{$subfile->subfile->subfile_hl_suffix}/".
                    ($subfile->subfile->hs_doc_heading ?? 'N/A')))
                ->toArray();

            return TooltipHelper::generateTooltip($subfileDisplay, $remainingSubfiles);
        }

        return $subfileDisplay;
    }

    /**
     * Get the adjudication section name for the place.
     */
    public function formatSection(Pou $place): string
    {
        return $place->water_rights->first()?->subfile?->adjudication_section?->adjudication_section_name ?? 'N/A';
    }

    /**
     * Get the county name of the place.
     */
    public function formatCounty(Pou $place): string
    {
        return $place->pou_irrigations->first()?->county?->county_name ?? 'N/A';
    }

    /**
     * Get the status use with formatting as a badge.
     */
    public function formatStatusUse(Pou $place): string
    {
        return $place->pou_status ? "<span class='badge badge-bluebubble'>{$place->pou_status->pou_status_code}</span>" : 'N/A';
    }

    /**
     * Format the updated date in m/d/Y format.
     */
    public function formatUpdatedDate(Pou $place): string
    {
        return optional($place->updated_at)->format('m/d/Y') ?? '--';
    }

    /**
     * Export selected records to CSV.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToCsv()
    {
        $fileName = $this->generateCsvFile($this->preparePlacesForExport($this->fetchSelectedPlaces()));

        return $this->downloadCsvFile($fileName);
    }

    /**
     * Fetch selected places for export.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function fetchSelectedPlaces()
    {
        return Pou::whereIn('id', $this->selectedRows)->get();
    }

    /**
     * Retrieves the full pou objects for the selected rows.
     *
     * This computed property fetches all pou objects that correspond to
     * the IDs stored in $selectedRows, allowing access to the full details
     * of each selected pou.
     */
    public function getSelectedPlacesOfUseProperty(): Collection
    {
        return $this->fetchSelectedPlaces();
    }

    /**
     * Bulk assigns selected Places of Use (POUs) to a specified Water Right.
     *
     * This method associates each selected POU, identified in `selectedRows`, with a specific Water Right
     * determined by `selectedWaterRightForBulkAction`. If an association between a POU and the Water Right
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
    public function savePouWaterRightBulkAction()
    {
        $waterRightId = $this->selectedWaterRightForBulkAction;

        $waterRight = WaterRight::find($waterRightId);

        // Attach the water right to the pou, if not already attached, with additional attributes
        $waterRight->pous()->syncWithoutDetaching(
            collect($this->selectedRows)->mapWithKeys(fn ($pouId) => [$pouId => [
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]])->toArray()
        );

        // Success message and close modal
        session()->flash('success', 'POUs successfully assigned to the water right.');
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
        $this->dispatch('hide-pou-water-rights-bulk-action-modal');
    }

    /**
     * Prepare data for CSV export.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $places
     * @return \Illuminate\Support\Collection
     */
    protected function preparePlacesForExport($places)
    {
        return $places->map(function ($place) {
            return [
                'PLID' => $place->id,
                'Place Type' => $this->formatPlaceType($place),
                'Acres' => $this->formatAcres($place),
                'Subfiles' => $this->getSubfilesForCsv($place),
                'Section' => $this->formatSection($place),
                'County' => $this->formatCounty($place),
                'Status Use' => strip_tags($this->formatStatusUse($place)),
                'Updated' => $this->formatUpdatedDate($place),
            ];
        });
    }

    /**
     * Get all subfiles as a comma-separated string for CSV.
     */
    protected function getSubfilesForCsv(Pou $place): string
    {
        return $place->water_rights
            ->filter(fn ($wr) => $wr->subfile)
            ->map(fn ($wr) => strtoupper("{$wr->subfile->basin_section_hl}-{$wr->subfile->sub_file_hl_txt}-{$wr->subfile->subfile_hl_suffix}/".
                ($wr->subfile->hs_doc_heading ?? 'N/A')))
            ->implode(', ');
    }

    /**
     * Generate CSV file and return file name.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @return string
     */
    protected function generateCsvFile($data)
    {
        $fileName = 'exported_places_of_use.csv';
        (new \Rap2hpoutre\FastExcel\FastExcel($data))->export(storage_path("app/public/{$fileName}"));

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
}
