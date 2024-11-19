@use('App\Models\Adjudication')

<div
    class="filter-sticky-header"
    role="button"
    data-bs-toggle="collapse"
    data-bs-target="#collapse_adjudications_filter"
>
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="filter-main-title">Adjudication Section</h4>
        <i class="bi bi-chevron-down"></i>
    </div>
</div>

<div class="form-check form-switch d-none">
    <input
        class="form-check-input"
        type="checkbox"
        id="flexSwitchCheckDefault"
    />
    <label class="form-check-label" for="flexSwitchCheckDefault">
        Show Other Bureaus
    </label>
</div>

<div class="collapse" id="collapse_adjudications_filter">
    @foreach (Adjudication::with('adjudication_sections')->get() as $adjudication)
        <section class="card card-body status-filters filter-dropdown-outline">
            <h4
                role="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse_adj_sec_{{ $adjudication->id }}"
                class="filter-dropdown-title"
            >
                <div class="d-flex justify-content-between">
                    {{ $adjudication->adjudication_name }}
                    <i class="bi bi-chevron-down"></i>
                </div>
            </h4>

            <div
                class="collapse dropdown-filter-options-list"
                id="collapse_adj_sec_{{ $adjudication->id }}"
            >
                @if ($adjudication->adjudication_sections->count() > 1)
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="adjudication_{{ $adjudication->id }}"
                            wire:model.live="filters.adjudicationIds.{{ $adjudication->id }}"
                            wire:click="selectAllChildren('App\\Models\\Adjudication', {{ $adjudication->id }}, 'adjudicationIds')"
                        />
                        <label
                            class="form-check-label"
                            for="adjudication_{{ $adjudication->id }}"
                        >
                            Select all
                        </label>
                    </div>
                    <hr class="m-2" />
                @endif

                @foreach ($adjudication->adjudication_sections as $section)
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="section_{{ $section->id }}"
                            value="{{ $section->id }}"
                            wire:model="filters.adjudicationSectionIds.{{ $section->id }}"
                        />

                        <label
                            class="form-check-label"
                            for="section_{{ $section->id }}"
                        >
                            {{ $section->adjudication_section_name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
</div>
