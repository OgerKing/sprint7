<div>
    <div class="adjudication-sections-table-container px-5 pb-5">
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
                            {{ $adjudicationName }} Sections
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="header col-md-10 col-sm-3">
                {{ $adjudicationName }} Adjudication Sections
            </div>

            <div class="col-md-2 text-end">
                @can('add or edit adjudication sections')
                    <button
                        type="button"
                        class="btn btn-outline-primary adjudication-button"
                        data-bs-target="#adjudicationSectionsModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        Add Section
                        <i class="bi bi-plus"></i>
                    </button>
                @endcan
            </div>
        </div>

        <div>
            <livewire:sections-and-subsections
                :adjudication_id="$adjudication_id"
                class="mx-5"
            />
        </div>
    </div>
    <div>
        <div
            class="modal fade"
            id="adjudicationSectionsModal"
            aria-hidden="true"
            data-bs-backdrop="static"
            aria-labelledby="adjudicationSectionsModalLabel"
            tabindex="-1"
            wire:ignore
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Adjudication Sections & Subsections
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$dispatch('resetFields')"
                            wire:confirm="Are you sure you want to navigate away from this form? Your progress will be lost."
                        ></button>
                    </div>
                    <div class="modal-form px-4 pb-4">
                        @livewire('components.update-section-form')
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
