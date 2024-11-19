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
                            {{ $adjudicationName }} Courts
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="header col-md-10 col-sm-3">
                {{ $adjudicationName }} Court Cases
            </div>

            <div class="col-md-2 text-end">
                @can($caj_permissions)
                    <button
                        type="button"
                        class="btn btn-outline-primary adjudication-button"
                        data-bs-target="#courtsAndJudgesModal"
                        data-bs-toggle="modal"
                        data-bs-dismiss="modal"
                    >
                        Add Court Case
                        <i class="bi bi-plus"></i>
                    </button>
                @endcan
            </div>
        </div>

        <div>
            <livewire:courts-and-judges-powergrid
                :adjudication_id="$adjudication_id"
                class="mx-5"
            />
        </div>
    </div>
    <div>
        <div
            class="modal fade"
            id="courtsAndJudgesModal"
            aria-hidden="true"
            aria-labelledby="courtsAndJudgesModalLabel"
            data-bs-backdrop="static"
            tabindex="-1"
            wire:ignore
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Courts
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            wire:click="$dispatch('resetCourtsAndJudgesFields')"
                            wire:confirm="Are you sure you want to navigate away from this form? Your progress will be lost."
                        ></button>
                    </div>
                    <div class="modal-form px-4 pb-4">
                        <livewire:components.courts-and-judges-form-html
                            :adjudication_id="$adjudication_id"
                        />
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
