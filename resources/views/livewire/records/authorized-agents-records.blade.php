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
                    <th scope="col" class="custom-table-cell">Name</th>
                    <th scope="col" class="custom-table-cell">Agent Type</th>
                    <th scope="col" class="custom-table-cell">Subfile(s)</th>
                    <th scope="col" class="custom-table-cell">
                        Persons Represented
                    </th>
                    <th scope="col" class="custom-table-cell">Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $agent)
                    <tr wire:key="authorized-agent-{{ $agent->id }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $agent->id }}"
                            />
                        </td>
                        <td class="custom-table-cell">
                            {{ $agent->last_name }},
                            {{ $agent->first_name }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->truncateText($agent->person_type_subtype->person_type_subtype_name ?? 'N/A') }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->generateSubfileTooltip($agent) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->getPersonsRepresented($agent) !!}
                        </td>
                        <td class="custom-table-cell">
                            {{ $agent->updated_at ? $agent->updated_at->format('m/d/Y') : 'N/A' }}
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
            id="authorizedAgentsBulkAssignDocsModal"
            aria-hidden="true"
            aria-labelledby="authorizedAgentsBulkAssignDocsModalLabel"
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
                            Assign Global Document to Authorized Agents
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            wire:click="$dispatch('resetDocumentsFields')"
                            wire:confirm="Are you sure you want to exit this form? Your progress will be lost."
                        ></button>
                    </div>

                    <div class="modal-form px-4 pb-4">
                        @if (count($selectedRows) > 0)
                            @livewire('components.global-documents-form-html', ['selectedRows' => $selectedRows, 'globalDocumentType' => 'Authorized Agents'], key(implode(',', $selectedRows)))
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($selectedRows) > 0)
        <div class="records-footer-toolbar">
            <!-- Selected Count -->
            <div class="d-flex align-items-center">
                <div class="selected-counter">
                    <span>{{ count($selectedRows) }}</span>
                </div>
                <span>selected</span>
            </div>

            <div class="d-flex">
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
