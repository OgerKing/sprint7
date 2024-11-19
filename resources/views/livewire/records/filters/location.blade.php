@use('App\Models\City')
@use('App\Models\County')
@use('App\Models\Court')
@use('App\Models\Grant')

<div
    class="filter-sticky-header"
    role="button"
    data-bs-toggle="collapse"
    data-bs-target="#collapse_locations_filter"
>
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="filter-main-title">Location</h4>
        <i class="bi bi-chevron-down"></i>
    </div>
</div>

@php
    $locationTypes = [
        [
            'query' => Court::query(),
            'title' => 'Court',
            'column_name' => 'court_name',
            'filter' => 'filters.courtIds',
        ],
        [
            'query' => County::query(),
            'title' => 'County',
            'column_name' => 'county_name',
            'filter' => 'filters.countyIds',
        ],
        [
            'query' => City::query()->whereRelation('state', 'state_abbreviation', 'NM'),
            'title' => 'City',
            'column_name' => 'city_name',
            'filter' => 'filters.cityIds',
        ],
        [
            'query' => Grant::query(),
            'title' => 'Grant',
            'column_name' => 'grant_name',
            'filter' => 'filters.grantIds',
        ],
    ];
@endphp

<div class="collapse" id="collapse_locations_filter">
    @foreach ($locationTypes as $locationType)
        <section
            class="card card-body mb-2 location-filters filter-dropdown-outline"
        >
            <h4
                role="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse_{{ $locationType['filter'] }}"
                class="filter-dropdown-title"
            >
                <div class="d-flex justify-content-between">
                    {{ $locationType['title'] }}
                    <i class="bi bi-chevron-down"></i>
                </div>
            </h4>
            <div
                class="collapse dropdown-filter-options-list"
                id="collapse_{{ $locationType['filter'] }}"
            >
                @foreach ($locationType['query']->get() as $model)
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="{{ $locationType['filter'] }}_{{ $model->id }}"
                            value="{{ $model->id }}"
                            wire:model="{{ $locationType['filter'] }}.{{ $model->id }}"
                        />
                        <label
                            class="form-check-label"
                            for="{{ $locationType['filter'] }}_{{ $model->id }}"
                            style="white-space: nowrap"
                        >
                            {{ $model->{$locationType['column_name']} }}
                        </label>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    <hr />

    <input
        type="text"
        class="form-control mb-2"
        placeholder="Hydrographic Survey Map Number"
        wire:model="filters.mapNumber"
    />
</div>
