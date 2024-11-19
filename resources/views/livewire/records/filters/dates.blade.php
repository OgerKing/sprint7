<div class="row">
    <div
        class="filter-sticky-header"
        role="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapse_dates_filter"
    >
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="filter-main-title">Dates</h4>
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>

    <div class="collapse" id="collapse_dates_filter">
        <div class="input-group my-3">
            <input
                type="date"
                class="form-control"
                placeholder="Date"
                wire:model="filters.dateStart"
            />
            <span class="input-group-text">to</span>
            <input
                type="date"
                class="form-control"
                placeholder="Date"
                wire:model="filters.dateEnd"
            />
        </div>
    </div>
</div>
