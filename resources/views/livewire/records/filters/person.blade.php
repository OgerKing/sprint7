@use('App\Models\PersonStatus')
@use('App\Models\PersonType')

<div
    class="filter-sticky-header"
    role="button"
    data-bs-toggle="collapse"
    data-bs-target="#collapse_persons_filter"
>
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="filter-main-title">Person Interest & Status</h4>
        <i class="bi bi-chevron-down"></i>
    </div>
</div>

<div class="collapse" id="collapse_persons_filter">
    <section class="card card-body mb-2 person-filters filter-dropdown-outline">
        <h4
            role="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapse_person_interest"
            class="filter-dropdown-title"
        >
            <div class="d-flex justify-content-between">
                <span>Person Type</span>
                <i class="bi bi-chevron-down"></i>
            </div>
        </h4>
        <div
            class="collapse dropdown-filter-options-list"
            id="collapse_person_interest"
        >
            @foreach (PersonType::with('person_type_subtypes')->get() as $personType)
                <div class="form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="filterPersonTypeIds_{{ $personType->id }}"
                        value="{{ $personType->id }}"
                        wire:model="filters.personTypeIds.{{ $personType->id }}"
                    />
                    <label
                        class="form-check-label"
                        for="filterPersonTypeIds_{{ $personType->id }}"
                    >
                        {{ $personType->person_type_name }}
                    </label>
                </div>
                @foreach ($personType->person_type_subtypes as $personTypeSubtype)
                    <div class="form-check mx-4">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="filterPersonTypeSubtypeIds_{{ $personTypeSubtype->id }}"
                            value="{{ $personTypeSubtype->id }}"
                            wire:model="filters.personTypeSubtypeIds.{{ $personTypeSubtype->id }}"
                        />
                        <label
                            class="form-check-label"
                            for="filterPersonTypeSubtypeIds_{{ $personTypeSubtype->id }}"
                        >
                            {{ $personTypeSubtype->person_type_subtype_name }}
                        </label>
                    </div>
                @endforeach
            @endforeach
        </div>
    </section>

    <section class="card card-body mb-2 person-filters filter-dropdown-outline">
        <h4
            role="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapse_person_status"
            class="filter-dropdown-title"
        >
            <div class="d-flex justify-content-between">
                <span>Person Status</span>
                <i class="bi bi-chevron-down"></i>
            </div>
        </h4>
        <div
            class="collapse dropdown-filter-options-list"
            id="collapse_person_status"
        >
            @foreach (PersonStatus::all() as $personStatus)
                <div class="form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="filterPersonStatusIds_{{ $personStatus->id }}"
                        value="{{ $personStatus->id }}"
                        wire:model="filters.personStatusIds.{{ $personStatus->id }}"
                    />
                    <label
                        class="form-check-label"
                        for="filterPersonStatusIds_{{ $personStatus->id }}"
                    >
                        {{ $personStatus->person_status_description }}
                    </label>
                </div>
            @endforeach
        </div>
    </section>
</div>
