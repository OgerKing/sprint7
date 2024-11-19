<div id="split-view">
    <div class="container split-container">
        <div class="row split-card">
            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-header">
                        Split Adjudication: {{ $adjudicationName }}
                    </div>
                    <div class="card-body">
                        <div class="row card-columns">
                            <div class="col-md-6 split-columns">
                                <div class="card-title mb-5">
                                    New Adjudication name generated
                                </div>
                                <div>
                                    <span class="badge numbered-badge">1</span>
                                    {{ $adjudicationName }} - A
                                    @if (count($selectedSections) > 0)
                                        <button
                                            class="btn add-selected-btn d-inline-flex align-items-center"
                                            wire:click="addToOriginalAdjudication"
                                        >
                                            <i class="bi bi-plus fs-4"></i>
                                            Add Selected
                                        </button>
                                    @endif

                                    <div>
                                        @foreach ($originalSectionNames as $id => $name)
                                            <span
                                                class="badge selected-section-pill my-1"
                                            >
                                                {{ $name }}
                                                <i
                                                    class="bi bi-x selected-badge"
                                                    wire:click="removeFromOriginalAdjudication({{ $id }})"
                                                    style="cursor: pointer"
                                                ></i>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <hr />
                                <div>
                                    <span class="badge numbered-badge">2</span>
                                    {{ $adjudicationName }} - B
                                    @if (count($selectedSections) > 0)
                                        <button
                                            class="btn add-selected-btn d-inline-flex align-items-center"
                                            wire:click="addToNewAdjudication"
                                        >
                                            <i class="bi bi-plus fs-4"></i>
                                            Add Selected
                                        </button>
                                    @endif

                                    <div>
                                        @foreach ($newSectionNames as $id => $name)
                                            <span
                                                class="badge selected-section-pill my-1"
                                            >
                                                {{ $name }}
                                                <i
                                                    class="bi bi-x selected-badge"
                                                    wire:click="removeFromNewAdjudication({{ $id }})"
                                                    style="cursor: pointer"
                                                ></i>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 section-column">
                                <div class="card-title">Available Sections</div>
                                <div class="mb-3">
                                    <label
                                        for="checkboxGroup"
                                        class="form-label"
                                    ></label>
                                    <div id="checkboxGroup">
                                        @if ($hasNoSections)
                                            This adjudication has no
                                                sections.
                                        @elseif (count($availableSections) !== 0)
                                            @foreach ($availableSections as $section)
                                                <div
                                                    class="available-section-cards my-2"
                                                >
                                                    <div
                                                        class="form-check custom-checkbox"
                                                    >
                                                        <label
                                                            class="form-check-label mx-2"
                                                            for="checkbox{{ $section['id'] }}"
                                                        >
                                                            <span
                                                                class="badge badge-pill"
                                                            >
                                                                {{ $section['prefix'] }}
                                                            </span>
                                                            @if (isset($section['subsections']) && count($section['subsections']))
                                                                <span
                                                                    class="subsection-count"
                                                                >
                                                                    {{ count($section['subsections']) }}
                                                                    Sub
                                                                    Section(s)
                                                                </span>
                                                            @endif
                                                        </label>
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            id="checkbox{{ $section['id'] }}"
                                                            value="{{ $section['id'] }}"
                                                            wire:model.live="selectedSections"
                                                        />
                                                    </div>
                                                    <div
                                                        class="mx-4 my-2 section-name"
                                                    >
                                                        {{ $section['adjudication_section_name'] }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <i class="bi bi-check-lg"></i>
                                            All sections connected
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer split-card-footer">
                        <div class="row my-2 mx-1">
                            @if (count($availableSections) > 0)
                                <span class="split-info mb-3">
                                    <i class="bi bi-info-circle"></i>
                                    You need to connect all sections to new
                                    adjudication, you have
                                    {{ count($availableSections) }} sections
                                    left.
                                </span>
                            @endif

                            <div class="col-6">
                                <button
                                    class="btn btn-grey w-100"
                                    type="button"
                                    type="reset"
                                    data-bs-dismiss="offcanvas"
                                    aria-label="Close"
                                    wire:click="cancelConfirmation"
                                    wire:confirm="Are you sure you want to navigate away from this page? Your progress will be lost."
                                >
                                    Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button
                                    class="btn btn-green btn-w-100"
                                    type="submit"
                                    :disabled="{{ count($availableSections) > 0 }}"
                                    wire:click="submit"
                                    wire:confirm="Are you sure you want to split this adjudication?"
                                >
                                    Split Adjudication
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
