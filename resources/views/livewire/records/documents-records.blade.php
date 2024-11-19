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
                    <th scope="col" class="custom-table-cell">Document Name</th>
                    <th scope="col" class="custom-table-cell">Category</th>
                    <th scope="col" class="custom-table-cell">Type</th>
                    <th scope="col" class="custom-table-cell">Status</th>
                    <th scope="col" class="custom-table-cell">Document Date</th>
                    <th scope="col" class="custom-table-cell">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $index => $document)
                    <tr wire:key="document-{{ $index }}">
                        <td class="custom-checkbox-cell">
                            <input
                                type="checkbox"
                                wire:model.live="selectedRows"
                                value="{{ $document->document_id . strtolower(str_replace(' ', '', $document->category)) }}"
                            />
                        </td>
                        <td class="custom-table-cell">
                            {{ $document->document_name }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $document->category }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $document->type }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $document->status }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $document->document_date }}
                        </td>
                        <td class="custom-table-cell">
                            {{ $document->updated }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>{{ $documents->links() }}</div>
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
                    wire:click="downloadSelectedDocuments"
                >
                    <i class="bi bi-download"></i>
                    Download Documents
                </button>
            </div>
        </div>
    @endif
</div>
