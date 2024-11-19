@use('App\Models\AdjudicationStatus')
@use('App\Models\PouStatus')
@use('App\Models\SubfileAdjudicationStatus')
@use('App\Models\WaterSource')
@use('App\Models\WatersStatus')

<div
    class="filter-sticky-header"
    role="button"
    data-bs-toggle="collapse"
    data-bs-target="#collapse_statuses_filter"
>
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="filter-main-title">Statuses & Element Types</h4>
        <i class="bi bi-chevron-down"></i>
    </div>
</div>

@php
    $sections = [
        AdjudicationStatus::class => [
            'label' => 'adjudication_status_description',
            'title' => 'Adjudication Status',
            'wire' => 'filters.adjudicationStatusIds',
        ],
        SubfileAdjudicationStatus::class => [
            'label' => 'subfile_adjudication_status_description',
            'title' => 'Subfile Status',
            'wire' => 'filters.subfileStatusIds',
        ],
        WatersStatus::class => [
            'label' => 'waters_status_description',
            'title' => 'Water Right Status',
            'wire' => 'filters.watersStatusesIds',
        ],
        PouStatus::class => [
            'label' => 'pou_status_description',
            'title' => 'Status Use',
            'wire' => 'filters.statusUseIds',
        ],
        WaterSource::class => [
            'label' => 'water_source_description',
            'title' => 'Water Source',
            'wire' => 'filters.waterSourceIds',
        ],
    ];
@endphp

<div class="collapse" id="collapse_statuses_filter">
    @foreach ($sections as $model => $details)
        <section class="card card-body status-filters filter-dropdown-outline">
            <h4
                role="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse_{{ $details['label'] }}"
                class="filter-dropdown-title"
            >
                <div class="d-flex justify-content-between">
                    {{ $details['title'] }}
                    <i class="bi bi-chevron-down"></i>
                </div>
            </h4>

            <div
                class="collapse dropdown-filter-options-list"
                id="collapse_{{ $details['label'] }}"
            >
                @foreach ($model::all() as $filterableModel)
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="{{ $details['label'] }}_{{ $filterableModel->id }}"
                            value="{{ $filterableModel->id }}"
                            wire:model="{{ $details['wire'] }}.{{ $filterableModel->id }}"
                        />

                        <label
                            class="form-check-label"
                            for="{{ $details['label'] }}_{{ $filterableModel->id }}"
                        >
                            {{ $filterableModel->{$details['label']} }}
                        </label>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    <section class="card card-body status-filters filter-dropdown-outline">
        <h4
            role="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapse_conveyance"
            class="filter-dropdown-title"
        >
            <div class="d-flex justify-content-between">
                <span>Conveyance</span>
                <i class="bi bi-chevron-down"></i>
            </div>
        </h4>
        <div
            class="collapse dropdown-filter-options-list"
            id="collapse_conveyance"
        >
            @foreach ([1, 2, 3, 4, 5] as $filterableModel)
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="conveyances_{{ $filterableModel }}"
                        value="{{ $filterableModel }}"
                        wire:model="filters.conveyanceIds.{{ $filterableModel }}"
                    />

                    <label
                        class="form-check-label"
                        for="conveyances_{{ $filterableModel }}"
                    >
                        {{ $filterableModel }}
                    </label>
                </div>
            @endforeach
        </div>
    </section>

    <hr />

    <input
        type="text"
        class="form-control mb-2"
        placeholder="Batch"
        wire:model="filters.batch"
    />
    <input
        type="text"
        class="form-control mb-2"
        placeholder="File Type"
        wire:model="filters.fileType"
    />
</div>
