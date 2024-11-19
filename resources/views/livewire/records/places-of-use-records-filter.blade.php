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

            @can('places-of-use-records-list-write-access')
                <div class="records-vertical-divider mx-2"></div>
                <button
                    type="button"
                    class="btn btn-outline-primary add-record-button mx-1"
                >
                    Add New Water Rights
                    <i class="bi bi-plus"></i>
                </button>
            @endcan
        </div>
    </div>

    @include('livewire.records.filters')
</div>
