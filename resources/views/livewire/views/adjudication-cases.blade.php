<div
    class="adjudications-cases-view container"
    x-data="{ showFilters: @entangle('showFilters') }"
>
    @livewire('components.adjudication-edit-sidebar')

    @livewire('components.adjudication-add-new-sidebar')

    @livewire('components.adjudication-changelog-sidebar')

    <div>
        <div class="row pt-4 mb-4 d-flex align-items-center">
            <div class="header col-lg-6 col-sm-3">Adjudication Cases</div>
            <div
                class="d-flex justify-content-end align-items-center col-lg-6 col-sm-9"
            >
                <div class="mx-1">
                    <div class="input-group search-input-wrapper">
                        <span class="input-group-text search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control search-input form-styles"
                            wire:model.live="search"
                            placeholder="Search"
                        />
                    </div>
                </div>
                <div class="mx-1">
                    <button
                        type="button"
                        class="btn btn-outline-success filter-button"
                        :class="{
                'shown': showFilters}"
                        @click="$wire.toggleFilters()"
                        aria-pressed="false"
                        autocomplete="off"
                    >
                        <div class="d-flex align-items-center">
                            <span>Filters</span>
                            <span>
                                <i x-show="showFilters" class="bi bi-x"></i>
                            </span>
                        </div>
                    </button>
                </div>
                @can('create adjudication')
                    <div class="adjudications-vertical-divider mx-2"></div>
                    <div class="mx-1">
                        <button
                            type="button"
                            class="btn btn-outline-primary adjudication-button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExampleAdd"
                            aria-controls="offcanvasExampleAdd"
                        >
                            Add New Adjudication
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                @endcan
            </div>
        </div>
        <div x-show="showFilters" class="my-3 filters-popup">
            <div class="card card-body">
                <div class="container">
                    <div
                        class="d-flex align-items-end justify-content-between mb-4"
                    >
                        <div class="d-flex align-items-end">
                            <div class="filters-title">Filters</div>
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="flexSwitchCheckDefault"
                                />
                                <label
                                    class="form-check-label"
                                    for="flexSwitchCheckDefault"
                                >
                                    Watching subfiles
                                </label>
                            </div>
                        </div>
                        <button class="btn" wire:click="clearAll">
                            Clear All
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <livewire:components.wrats-dropdown-select
                                :id="'bureau-dropdown'"
                                :label="'Bureau'"
                                :selected-item="$selectedBureau"
                                :emit-to="'selectBureau'"
                                :options="$bureauOptions"
                            />
                        </div>

                        <div class="form-group col-3">
                            @livewire('components.adjudication-status-dropdown-select', ['selectedAdjudicationStatuses' => $statusFilters])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <button
                                class="btn btn-grey"
                                type="button"
                                wire:click="cancelFilter"
                            >
                                Cancel
                            </button>
                            <button
                                class="btn btn-green"
                                type="submit"
                                wire:click="applyFilters"
                            >
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($adjudications as $adjudication)
                <div
                    class="card-container col-4 mb-3"
                    wire:key="adjudication-card-{{ $adjudication['id'] }}"
                >
                    @livewire('components.adjudication-cards', ['adjudication' => $adjudication], key($adjudication->id))
                </div>
            @endforeach
        </div>
    </div>
</div>
