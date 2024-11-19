<div class="mt-4 subfile-records">
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

                    <th scope="col" class="custom-table-cell">Subfile ID</th>
                    <th scope="col" class="custom-table-cell">Case Number</th>
                    <th scope="col" class="custom-table-cell">
                        Active Persons
                    </th>
                    <th scope="col" class="custom-table-cell">Status</th>
                    <th scope="col" class="custom-table-cell">County</th>
                    <th scope="col" class="custom-table-cell">Start Date</th>
                    <th scope="col" class="custom-table-cell">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $subfile)
                    <tr wire:key="subfile-{{ $subfile->id }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $subfile->id }}"
                            />
                        </td>

                        <td class="custom-table-cell">
                            {{ $this->formatSubfileID($subfile) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->formatCaseNumber($subfile) !!}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->formatActivePersons($subfile) !!}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->truncateStatus($subfile) !!}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatCounty($subfile) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $subfile->sub_file_start_date ? $subfile->sub_file_start_date->format('m/d/Y') : '--' }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $subfile->updated_at ? $subfile->updated_at->format('m/d/Y') : '--' }}
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
                <button
                    type="button"
                    class="export-button border-0"
                    data-bs-target="#subfilesRecordsWatchModal"
                    data-bs-toggle="modal"
                    data-bs-dismiss="modal"
                >
                    <i class="bi bi-eye"></i>
                    Watch
                </button>
                @can('attorney-and-up')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#subfilesRecordsAttorneyModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-arrow-repeat"></i>
                        Update Attorney
                    </button>
                @endcan

                @can('attorney-and-up')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#subfilesRecordsStatusModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-pencil"></i>
                        Change Status
                    </button>
                @endcan

                @can('bulk-change-subfile-documents')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#subfilesRecordsBulkAssignDocsModal"
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

    <!-- Change Attorney Bulk Action Modal -->
    <div>
        <div
            class="modal fade"
            id="subfilesRecordsAttorneyModal"
            aria-hidden="true"
            aria-labelledby="subfilesRecordsAttorneyModalLabel"
            data-bs-backdrop="static"
            tabindex="-1"
        >
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Bulk Change OSE Attorney
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
                                <div class="row card-columns">
                                    <div class="col-md-6 split-columns">
                                        <div class="card-title mb-5">
                                            Current Assigned OSE Resource
                                        </div>
                                        <div>
                                            @foreach ($this->selectedSubfiles as $subfile)
                                                <div class="subfile-item">
                                                    {{ $this->formatSubfileID($subfile) }}:
                                                    <strong>
                                                        {{ $subfile->attorney ? $subfile->attorney->last_name : 'No Attorney Assigned' }}
                                                    </strong>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6 split-columns">
                                        <div class="card-title">
                                            Choose New OSE Attorney
                                        </div>
                                        <div class="mb-3">
                                            <div
                                                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                                            >
                                                <label class="input-label">
                                                    Choose New OSE Attorney
                                                </label>
                                                <select
                                                    wire:model="selectedSubfileAttorneyForBulkAction"
                                                    class="btn dropdown-toggle form-styles"
                                                >
                                                    <option value="null">
                                                        Select an option...
                                                    </option>

                                                    @foreach ($subfileAttorneyOptions as $option)
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
                                            wire:click="saveSubfileAttorneyBulkAction"
                                            wire:confirm="Are you sure you want to save these changes?"
                                        >
                                            Change OSE Attorney
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

    <!-- Change Status Bulk Action Modal -->
    <div>
        <div
            class="modal fade"
            id="subfilesRecordsStatusModal"
            aria-hidden="true"
            aria-labelledby="subfilesRecordsStatusModalLabel"
            data-bs-backdrop="static"
            tabindex="-1"
        >
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Bulk Change Subfile Status
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
                                <div class="row card-columns">
                                    <div class="col-md-6 split-columns">
                                        <div class="card-title mb-5">
                                            Current Subfile Status(es)
                                        </div>

                                        @foreach ($this->selectedSubfiles as $subfile)
                                            <div class="subfile-item">
                                                {{ $this->formatSubfileID($subfile) }}
                                                <strong>
                                                    {{ $subfile->subfile_adjudication_status->subfile_adjudication_status_description }}
                                                </strong>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6 split-columns">
                                        <div class="card-title">
                                            Choose New Subfile Status
                                        </div>
                                        <div class="mb-3">
                                            <div
                                                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                                            >
                                                <label class="input-label">
                                                    Choose New Subfile Status
                                                </label>
                                                <select
                                                    wire:model="selectedSubfileStatusForBulkAction"
                                                    class="btn dropdown-toggle form-styles"
                                                >
                                                    <option value="null">
                                                        Select an option...
                                                    </option>

                                                    @foreach ($subfileStatusOptions as $option)
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
                                            wire:click="saveSubfileStatusBulkAction"
                                            wire:confirm="Are you sure you want to save these changes?"
                                        >
                                            Change Subfile Status
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

    <!-- Toggle On/Off Watch Bulk Action Modal -->
    <div>
        <div
            class="modal fade"
            id="subfilesRecordsWatchModal"
            aria-hidden="true"
            aria-labelledby="subfilesRecordsWatchModalLabel"
            data-bs-backdrop="static"
            tabindex="-1"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Bulk Watch Subfiles
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
                            <div class="card-body d-flex">
                                <button
                                    class="btn btn-green btn-w-100 mx-2"
                                    type="button"
                                    wire:click="subfileAddWatcher"
                                    wire:confirm="Are you sure you want to add these subfiles to your watch list?"
                                >
                                    Add {{ count($selectedRows) }} Watched
                                    Subfile(s)
                                </button>

                                <button
                                    class="btn btn-danger btn-w-100 mx-2"
                                    type="button"
                                    wire:click="subfileRemoveWatcher"
                                    wire:confirm="Are you sure you want to stop watching these subfiles?"
                                >
                                    Stop Watching {{ count($selectedRows) }}
                                    Subfile(s)
                                </button>
                            </div>
                            <div class="card-footer split-card-footer">
                                <div class="row my-2 mx-1">
                                    <div class="col-12">
                                        <button
                                            class="btn btn-grey w-100"
                                            type="button"
                                            type="reset"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                            wire:click="cancelAndCloseModals"
                                            wire:confirm="Are you sure you want to navigate away from modal?"
                                        >
                                            Cancel
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

    <!-- Assign Documents -->
    <div id="global-documents-modal-container">
        <div
            class="modal fade"
            data-bs-backdrop="static"
            id="subfilesRecordsBulkAssignDocsModal"
            aria-hidden="true"
            aria-labelledby="subfilesRecordsBulkAssignDocsModalLabel"
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
                            Assign Global Document to Subfiles
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
                            @livewire('components.global-documents-form-html', ['selectedRows' => $selectedRows, 'globalDocumentType' => 'Subfiles'], key(implode(',', $selectedRows)))
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
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
