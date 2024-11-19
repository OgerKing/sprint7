@props([
    'selectedAdjudicationStatuses' => [],
])

<div
    class="dropdown menu-options form-floating"
    id="adjudication-status-dropdown-select"
    x-data="{
        selectedAdjudicationStatuses: @entangle('selectedAdjudicationStatuses'),
        isChecked(value) {
            return this.selectedAdjudicationStatuses.includes(value)
        },
    }"
>
    <label for="dropdownMenuButton" class="input-label">Status</label>
    <button
        class="btn dropdown-toggle form-styles"
        type="button"
        id="dropdownMenuButton"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        color="transparent"
    >
        {{ count($selectedAdjudicationStatuses) ? count($selectedAdjudicationStatuses) . ' Selected' : 'Select Statuses' }}
    </button>

    <ul
        class="dropdown-menu dropdown-menu-end"
        aria-labelledby="navbarDropdown"
    >
        @foreach ($statusOptions as $option)
            <li wire:key="status-option-{{ $option['value'] }}">
                <div class="dropdown-item">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="recordTypes[]"
                            id="{{ Str::slug($option['label']) }}"
                            value="{{ $option['value'] }}"
                            :checked="isChecked('{{ $option['value'] }}')"
                            wire:click="selectStatuses('{{ $option['value'] }}')"
                            wire:key="status-option-{{ $option['value'] }}"
                        />
                        <label
                            class="form-check-label"
                            for="{{ Str::slug($option['label']) }}"
                        >
                            {{ $option['label'] }}
                        </label>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
