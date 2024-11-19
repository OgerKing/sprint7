<div x-show="showFilters" class="my-3 filters-popup col-lg-12">
    <div class="card card-body">
        <div class="d-flex align-items-end justify-content-between">
            <div class="d-flex align-items-end">
                <div class="filters-title">
                    Filters
                    @if ($this->activeFiltersCount > 0) ({{ $this->activeFiltersCount }}) @endif
                </div>
                <div class="form-check form-switch ms-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="watchingSubfiles"
                        wire:model.live="filters.watchingSubfiles"
                    />
                    <label
                        class="form-check-label"
                        for="watchingSubfiles"
                    >
                        Watching Subfiles
                    </label>
                </div>
            </div>

            <button class="btn" wire:click="clearAll">
                Clear All
                <i class="bi bi-arrow-repeat"></i>
            </button>
        </div>

        <div class="row d-none">
            <div class="form-group col-2">
                <div
                    class="dropdown ua-dropdown-select menu-options form-floating"
                    x-data="{ disabled: @entangle('disabled') }"
                >
                    <select
                        wire:model="subfileSelectionFilter"
                        class="btn dropdown-toggle form-styles"
                    >
                        <option value="">Select subfile...</option>
                        @foreach ($subfileOptions as $option)
                            <option value="{{ $option->id }}">
                                {{ $option->basin_section_hl }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--
                <div class="form-group col-2">
                <div class="dropdown ua-dropdown-select menu-options form-floating" x-data="{ disabled: @entangle('disabled') }">
                <select wire:model="modelSelectionFilter" class="btn dropdown-toggle form-styles">
                <option value="">Select...</option>
                @foreach ($modelOptions as $model)
                <option value="{{ $model->id }}">
                {{ $model->first_name }} {{ $model->last_name }}
                </option>
                @endforeach
                </select>
                </div>
                </div>
            --}}
        </div>

        <div class="container">
            <div class="row d-flex align-items-start justify-content-center">
                <div
                    class="col mx-1 mt-4 px-3 filter-col records-filters-container"
                >
                    @include('livewire.records.filters.adjudications')
                </div>

                <div
                    class="col mx-1 mt-4 px-3 filter-col records-filters-container"
                >
                    @include('livewire.records.filters.statuses')
                </div>

                <div
                    class="col mx-1 mt-4 px-3 filter-col records-filters-container"
                >
                    @include('livewire.records.filters.dates')
                </div>
            </div>
            <div class="row d-flex align-items-start justify-content-center">
                <div
                    class="col mx-1 mt-4 px-3 filter-col records-filters-container"
                >
                    @include('livewire.records.filters.person')
                </div>
                <div
                    class="col mx-1 mt-4 px-3 filter-col records-filters-container"
                >
                    @include('livewire.records.filters.location')
                </div>
            </div>
        </div>

        <div class="row mt-3">
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
