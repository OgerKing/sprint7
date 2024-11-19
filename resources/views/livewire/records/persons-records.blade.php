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
                    <th scope="col" class="custom-table-cell">Person Type</th>
                    <th scope="col" class="custom-table-cell">Email</th>
                    <th scope="col" class="custom-table-cell">Phone Number</th>
                    <th scope="col" class="custom-table-cell">Subfile(s)</th>
                    <th scope="col" class="custom-table-cell">
                        Authorized Agent(s)
                    </th>
                    <th scope="col" class="custom-table-cell">Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $person)
                    <tr wire:key="person-{{ $person->id }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $person->id }}"
                            />
                        </td>

                        <td class="custom-table-cell">
                            {{ $person->last_name }},
                            {{ $person->first_name }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->truncateText($person->person_type_subtype->person_type_subtype_name ?? 'N/A') }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->truncateText($person->person_email->primary_contact_email ?? 'N/A') }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $person->person_telephone->primary_person_telephone_anumber ?? 'N/A' }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $this->generateSubfileTooltip($person) }}
                        </td>
                        <td class="custom-table-cell">
                            {!! $this->generateAuthorizedAgentsTooltip($person) !!}
                        </td>
                        <td class="custom-table-cell">
                            {{ $person->updated_at ? $person->updated_at->format('m/d/Y') : 'N/A' }}
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
            id="personsRecordsBulkAssignDocsModal"
            aria-hidden="true"
            aria-labelledby="personsRecordsBulkAssignDocsModalLabel"
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
                            Assign Global Document to Persons
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
                            @livewire('components.global-documents-form-html', ['selectedRows' => $selectedRows, 'globalDocumentType' => 'Persons'], key(implode(',', $selectedRows)))
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
                <!-- Assign Documents Button -->
                <button
                    type="button"
                    class="export-button border-0"
                    data-bs-target="#personsRecordsBulkAssignDocsModal"
                    data-bs-toggle="modal"
                    data-bs-dismiss="modal"
                >
                    <i class="bi bi-file-earmark"></i>
                    Assign Documents
                </button>
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
