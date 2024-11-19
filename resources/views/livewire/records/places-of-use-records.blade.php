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
                    <th scope="col" class="custom-table-cell">PLID</th>
                    <th scope="col" class="custom-table-cell">Place Type</th>
                    <th scope="col" class="custom-table-cell">Acres</th>
                    <th scope="col" class="custom-table-cell">Subfile(s)</th>
                    <th scope="col" class="custom-table-cell">Section</th>
                    <th scope="col" class="custom-table-cell">County</th>
                    <th scope="col" class="custom-table-cell">Status Use</th>
                    <th scope="col" class="custom-table-cell">Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $place)
                    <tr wire:key="place-{{ $place->id }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $place->id }}"
                            />
                        </td>
                        <td class="custom-table-cell">{{ $place->id }}</td>
                        <td class="custom-table-cell">
                            {{ $this->formatPlaceType($place) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatAcres($place) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->formatSubfiles($place) !!}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatSection($place) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatCounty($place) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->formatStatusUse($place) !!}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatUpdatedDate($place) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>{{ $models->links() }}</div>
    </div>

    <!-- Assign Documents -->
    <div id="global-documents-modal-container">
        <div
            class="modal fade"
            data-bs-backdrop="static"
            id="placesOfUseRecordsBulkAssignDocsModal"
            aria-hidden="true"
            aria-labelledby="placesOfUseRecordsBulkAssignDocsModalLabel"
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
                            Assign Global Document to Places of Use
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
                            @livewire('components.global-documents-form-html', ['selectedRows' => $selectedRows, 'globalDocumentType' => 'Places of Use'], key(implode(',', $selectedRows)))
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                @can('bulk-change-pou-rights')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#placesOfUseBulkAssignRightsModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-file-earmark"></i>
                        Add to Right
                    </button>
                @endcan

                @can('bulk-change-pou-documents')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#placesOfUseRecordsBulkAssignDocsModal"
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

    <!-- Add To Rights Modal -->
    <div id="pou-rights-modal-container">
        <div
            class="modal fade"
            data-bs-backdrop="static"
            id="placesOfUseBulkAssignRightsModal"
            aria-hidden="true"
            aria-labelledby="placesOfUseBulkAssignRightsModalLabel"
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
                                Bulk Assign POUs to Water Right
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
                                                Selected POUs
                                            </div>
                                            <div class="item px-3">
                                                @foreach ($this->selectedPlacesOfUse as $pou)
                                                    <div>{{ $pou->id }}</div>
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
                                                wire:click="savePouWaterRightBulkAction"
                                                wire:confirm="Are you sure you want to save these changes?"
                                            >
                                                Add POUs to Water Right
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
</div>
