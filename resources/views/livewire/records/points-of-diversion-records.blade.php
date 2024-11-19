<div class="mt-4">
    <div class="table-responsive records-table">
        <table
            class="table table-bordered table-hover align-middle custom-table-wrapper"
        >
            <thead class="table-light">
                <tr>
                    <th scope="col" class="custom-checkbox-cell">
                        <input
                            type="checkbox"
                            wire:click="toggleSelectAllManual"
                            {{ $selectAll ? 'checked' : '' }}
                        />
                    </th>
                    <th scope="col" class="custom-table-cell">SID</th>
                    <th scope="col" class="custom-table-cell">OSE File No</th>
                    <th scope="col" class="custom-table-cell">Subfile(s)</th>
                    <th scope="col" class="custom-table-cell">Section</th>
                    <th scope="col" class="custom-table-cell">County</th>
                    <th scope="col" class="custom-table-cell">Updated</th>
                    <th scope="col" class="custom-table-cell">
                        POD Source Origin
                    </th>
                    <th scope="col" class="custom-table-cell">POD #</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $pod)
                    <tr wire:key="pod-{{ $pod->id }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $pod->id }}"
                            />
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatSid($pod) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatOseFile($pod) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->formatSubfiles($pod) !!}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatSection($pod) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatCounty($pod) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatUpdatedDate($pod) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatWaterSource($pod) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatPodNumber($pod) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>{{ $models->links() }}</div>
    </div>

    @if (count($selectedRows) > 0)
        <div class="records-footer-toolbar mt-3">
            <div class="d-flex align-items-center">
                <div class="selected-counter">
                    <span>{{ count($selectedRows) }}</span>
                </div>
                <span>selected</span>
            </div>
            <div class="d-flex">
                @can('bulk-change-pod-rights')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#pointsOfDiversionBulkAssignRightsModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-file-earmark"></i>
                        Add to Right
                    </button>
                @endcan

                @can('bulk-change-pod-documents')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#pointsOfDiversionRecordsBulkAssignDocsModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-file-earmark"></i>
                        Assign Documents
                    </button>
                @endcan

                <button
                    type="button"
                    class="export-button border-0"
                    wire:click="exportToCsv"
                >
                    <i class="bi bi-download"></i>
                    Export
                </button>
            </div>
        </div>
    @endif

    <!-- Assign Documents -->
    <div id="global-documents-modal-container">
        <div
            class="modal fade"
            data-bs-backdrop="static"
            id="pointsOfDiversionRecordsBulkAssignDocsModal"
            aria-hidden="true"
            aria-labelledby="pointsOfDiversionRecordsBulkAssignDocsModalLabel"
            tabindex="-1"
            x-data="{
                selectedRows: @entangle('selectedRows'),
            }"
        >
            <div
                class="modal-dialog modal-dialog-centered"
                x-show="selectedRows.length > 0"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Assign Global Document to Points of Diversion
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            wire:click="$dispatch('resetDocumentsFields)"
                            wire:confirm="Are you sure you want to exit this form? Your progress will be lost."
                        ></button>
                    </div>

                    <div class="modal-form px-4 pb-4">
                        @if (count($selectedRows) > 0)
                            @livewire('components.global-documents-form-html', ['selectedRows' => $selectedRows, 'globalDocumentType' => 'Points of Diversion'], key(implode(',', $selectedRows)))
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add To Rights Modal -->
    <div id="pod-rights-modal-container">
        <div
            class="modal fade"
            data-bs-backdrop="static"
            id="pointsOfDiversionBulkAssignRightsModal"
            aria-hidden="true"
            aria-labelledby="pointsOfDiversionBulkAssignRightsModalLabel"
            tabindex="-1"
            x-data="{
                selectedRows: @entangle('selectedRows'),
            }"
        >
            <div
                class="modal-dialog modal-dialog-centered"
                x-show="selectedRows.length > 0"
            >
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                Bulk Assign POD to Water Right
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                                wire:click="cancelAndCloseModals"
                                wire:confirm="Are you sure you want to navigate away from this form? Your progress will be lost."
                            ></button>
                        </div>
                        <div class="modal-form">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row card-columns px-5">
                                        <div class="col-md-6 split-columns">
                                            <div class="card-title">
                                                Selected PODs
                                            </div>
                                            <div class="item px-3">
                                                @foreach ($this->selectedPointsOfDiversion as $pod)
                                                    <div>{{ $pod->id }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6 split-column-2">
                                            <div class="card-title">
                                                Select Water Right
                                            </div>
                                            <div class="mb-3">
                                                <div
                                                    class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                                                >
                                                    <label class="input-label">
                                                        Choose Water Right
                                                    </label>
                                                    <select
                                                        wire:model="selectedWaterRightForBulkAction"
                                                        class="btn dropdown-toggle form-styles"
                                                    >
                                                        <option value="null">
                                                            Select an option...
                                                        </option>

                                                        @foreach ($waterRightsOptions as $option)
                                                            <option
                                                                value="{{ $option['value'] }}"
                                                            >
                                                                {{ $option['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer split-card-footer">
                                    <div class="row my-2 mx-1">
                                        <div class="col-6">
                                            <button
                                                class="btn btn-grey w-100"
                                                type="button"
                                                type="reset"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                                wire:click="cancelAndCloseModals"
                                                wire:confirm="Are you sure you want to navigate away from this page? Your progress will be lost."
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button
                                                class="btn btn-green btn-w-100"
                                                type="button"
                                                wire:click="savePodWaterRightBulkAction"
                                                wire:confirm="Are you sure you want to save these changes?"
                                            >
                                                Add PODs to Water Right
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]'),
            );
            var tooltipList = tooltipTriggerList.map(
                function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                },
            );
        });
    </script>
</div>
