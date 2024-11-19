<div x-data="{ showFilters: @entangle('showFilters') }">
    <div class="d-flex align-items-center">
        <livewire:records-page-selector />

        <div
            class="col-lg-6 col-sm-9 d-flex justify-content-between align-items-center mx-3"
        >
            <div
                class="input-group search-input-wrapper mx-1 flex-grow-1 position-relative"
            >
                <div class="dropdown-wrapper">
                    <button
                        class="btn btn-secondary dropdown-toggle form-select-inline"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Subfile ID
                    </button>
                    <ul
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <li class="dropdown-item">Owner Name</li>
                        <li class="dropdown-item">Attorney Name</li>
                        <li class="dropdown-item">Address</li>
                        <li class="dropdown-item">Email</li>
                        <li class="dropdown-item">Phone</li>
                        <li class="dropdown-item selected-dropdown-id">
                            Subfile ID
                        </li>
                        <li class="dropdown-item">Case Number</li>
                        <li class="dropdown-item">OSE Number</li>
                        <li class="dropdown-item">POU Number</li>
                        <li class="dropdown-item">PLID</li>
                        <li class="dropdown-item">SID</li>
                        <li class="dropdown-item">OSE File Number</li>
                        <li class="dropdown-item">Right ID</li>
                        <li class="dropdown-item">Non-Standard #</li>
                        <li class="dropdown-item">Waters POD #</li>
                    </ul>
                </div>
                <input
                    type="text"
                    class="form-control search-input form-styles"
                    placeholder="Filter Keyword"
                    oninput="this.nextElementSibling.style.display = this.value ? 'none' : 'block';"
                />
                <span class="search-icon position-absolute">
                    <i class="bi bi-search"></i>
                </span>
            </div>

            <button
                type="button"
                class="btn btn-outline-success filter-button"
                :class="{ 'shown': showFilters }"
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

            @can('documents-records-list-write-access')
                <div class="records-vertical-divider mx-2"></div>
                <button
                    type="button"
                    class="btn btn-outline-primary add-record-button mx-1"
                >
                    Add New Document
                    <i class="bi bi-plus"></i>
                </button>
            @endcan
        </div>
    </div>

    <div x-show="showFilters" class="my-3 filters-popup col-lg-12">
        <div class="card card-body">
            <div class="d-flex align-items-end justify-content-between mb-4">
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
                <div class="form-group col-3">Coming Soon</div>
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
