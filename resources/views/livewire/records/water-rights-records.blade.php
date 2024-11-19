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
                    <th scope="col" class="custom-table-cell">Right ID</th>
                    <th scope="col" class="custom-table-cell">
                        Subfile/Header
                    </th>
                    <th scope="col" class="custom-table-cell">Purpose</th>
                    <th scope="col" class="custom-table-cell">
                        Active Persons
                    </th>
                    <th scope="col" class="custom-table-cell">
                        HS Work Status
                    </th>
                    <th scope="col" class="custom-table-cell">Priority Date</th>
                    <th scope="col" class="custom-table-cell">Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $waterRight)
                    <tr wire:key="waterRight-{{ $waterRight->id }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $waterRight->id }}"
                            />
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatRightID($waterRight) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->formatSubfileDetails($waterRight) }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->truncateText($waterRight) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->formatActivePersons($waterRight) !!}
                        </td>
                        <td class="custom-table-cell">
                            <span class="badge badge-bluebubble">
                                +{{ $waterRight->right_status_id }}
                            </span>
                        </td>
                        <td class="custom-table-cell">
                            {{
                                count($waterRight->pod_water_rights)
                                    ? ($waterRight->pod_water_rights->first()->priority_date
                                        ? $waterRight->pod_water_rights->first()->priority_date->format('m/d/Y')
                                        : 'Null')
                                    : 'No Data'
                            }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $waterRight->updated_at->format('m/d/Y') }}
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
            id="waterRightsRecordsBulkAssignDocsModal"
            aria-hidden="true"
            aria-labelledby="waterRightsRecordsBulkAssignDocsModalLabel"
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
                            Assign Global Document to Water RIghts
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
                            @livewire('components.global-documents-form-html', ['selectedRows' => $selectedRows, 'globalDocumentType' => 'Water Rights'], key(implode(',', $selectedRows)))
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($selectedRows) > 0)
        <div class="records-footer-toolbar mt-3">
            <!-- Selected Count -->
            <div class="d-flex align-items-center">
                <div class="selected-counter">
                    <span>{{ count($selectedRows) }}</span>
                </div>
                <span>selected</span>
            </div>
            <div class="d-flex">
                <!-- Assign Documents -->
                @can('bulk-change-water-rights-documents')
                    <button
                        type="button"
                        class="export-button border-0"
                        data-bs-target="#waterRightsRecordsBulkAssignDocsModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-file-earmark"></i>
                        Assign Documents
                    </button>
                @endcan

                <!-- Export Button -->
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
</div>
