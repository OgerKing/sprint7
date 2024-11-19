<div>
    <div
        class="global-documents-table-container adjudication-sections-table-container px-5 pb-5"
    >
        <div class="row mb-3 pt-5 pb-2">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <i class="bi bi-arrow-left-short"></i>

                        <li class="breadcrumb-item">
                            <a wire:navigate href="/adjudications">
                                Adjudications
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $adjudication ? $adjudication->adjudication_name : '' }}
                            Documents
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-between">
                <div class="header">
                    {{ $adjudication ? $adjudication->adjudication_name : '' }}
                    Documents
                </div>

                <button
                    type="button"
                    class="btn btn-outline-primary adjudication-button"
                    data-bs-target="#globalDocumentsModal"
                    data-bs-toggle="modal"
                    data-bs-dismiss="modal"
                >
                    Add New Document
                    <i class="bi bi-plus"></i>
                </button>
            </div>
        </div>

        <div>
            <livewire:global-documents-powergrid
                :adjudication_id="$adjudication_id"
                class="mx-5"
            />
        </div>
    </div>
    <div id="global-documents-modal-container">
        <div
            class="modal fade"
            data-bs-backdrop="static"
            id="globalDocumentsModal"
            aria-hidden="true"
            aria-labelledby="globalDocumentsModalLabel"
            tabindex="-1"
            wire:ignore
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Assign Global Document to Adjudication
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
                        @livewire('components.global-documents-form-html', ['globalDocumentType' => 'Adjudication'])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @persist('snackbar')
        @livewire('components.snackbar-notification')
    @endpersist
</div>
