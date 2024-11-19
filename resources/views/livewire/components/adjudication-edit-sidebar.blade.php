<div id="adjudication-edit-sidebar">
    <div x-data="{
        isOpen: @entangle('isOpen'),
    }">
        <div
            x-show="isOpen"
            class="offcanvas-backdrop offcanvas-end fade show"
        ></div>

        <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            wire:ignore.self
            x-data="{
                isEditable: @entangle('isEditable'),
                mapping_zone_west: @entangle('mapping_zone_west'),
                mapping_zone_east: @entangle('mapping_zone_east'),
                mapping_zone_central: @entangle('mapping_zone_central'),
            }"
        >
            <div class="offcanvas-header pb-0">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    Edit Adjudication
                </h5>
                <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                    wire:click="isEditable = false"
                    @click="isOpen = false"
                ></button>
            </div>
            <hr />

            <div class="offcanvas-body pt-0">
                <form wire:submit.prevent="submit" class="edit-form">
                    <div>
                        <div class="mb-4">
                            <x-wrats-basic-text-input
                                label="Title"
                                id="title"
                                wire:model="form.adjudication_name"
                                :disabled="!$isEditable"
                                tooltipContent="{{ config('tooltip-config.adjudication.adjudication_name') }}"
                            />
                            @error('form.adjudication_name')
                                <span class="text-danger inline-error-msg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <x-wrats-basic-text-input
                                class="my-4"
                                label="Adjudication Prefix"
                                id="prefix"
                                wire:model="form.prefix"
                                maxLength="10"
                                :disabled="!$isEditable"
                                maxLength="10"
                                tooltipContent="{{ config('tooltip-config.adjudication.prefix') }}"
                            />
                            @error('form.prefix')
                                <span class="text-danger inline-error-msg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <x-wrats-basic-text-input
                                class="my-4"
                                label="Nickname"
                                id="nickname"
                                wire:model="form.adjudication_nickname"
                                :disabled="!$isEditable"
                                tooltipContent="{{ config('tooltip-config.adjudication.adjudication_nickname') }}"
                            />
                            @error('form.adjudication_nickname')
                                <span class="text-danger inline-error-msg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="my-4">
                            <div
                                id="parent-section"
                                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                            >
                                <div
                                    class="input-label-with-tooltip d-flex align-items-center"
                                >
                                    Status
                                    <x-wrats-tooltip
                                        tooltipContent="{{ config('tooltip-config.adjudication.adjudication_status') }}"
                                    />
                                </div>
                                <select
                                    wire:model="form.adjudication_status_id"
                                    class="btn dropdown-toggle form-styles"
                                    @if (!$isEditable) disabled @endif
                                >
                                    <option disabled value="">
                                        Select an option...
                                    </option>
                                    <option value="">None</option>

                                    @foreach ($statusOptions as $option)
                                        <option value="{{ $option['value'] }}">
                                            {{ $option['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form.adjudication_status_id')
                                <span class="text-danger inline-error-msg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <div
                                id="parent-section"
                                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                            >
                                <div
                                    class="input-label-with-tooltip d-flex align-items-center"
                                >
                                    Bureau

                                    <x-wrats-tooltip
                                        tooltipContent="{{ config('tooltip-config.adjudication.bureau') }}"
                                    />
                                </div>
                                <select
                                    wire:model="form.bureau_id"
                                    class="btn dropdown-toggle form-styles"
                                    @if (!$isEditable) disabled @endif
                                >
                                    <option disabled value="">
                                        Select an option...
                                    </option>
                                    <option value="">None</option>

                                    @foreach ($bureauOptions as $option)
                                        <option value="{{ $option['value'] }}">
                                            {{ $option['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form.bureau_id')
                                <span class="text-danger inline-error-msg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="mapping-title">Mapping Zones</div>

                        <div class="d-flex justify-content-between">
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    value="1"
                                    wire:model="form.mapping_zone_west"
                                    :disabled="!isEditable"
                                />
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox1"
                                >
                                    West
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox2"
                                    value="1"
                                    wire:model="form.mapping_zone_central"
                                    :disabled="!isEditable"
                                />
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox2"
                                >
                                    Central
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox3"
                                    value="1"
                                    wire:model="form.mapping_zone_east"
                                    :disabled="!isEditable"
                                />
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox3"
                                >
                                    East
                                </label>
                            </div>
                        </div>

                        @error('mapping_zones')
                            <span class="text-danger inline-error-msg">
                                Please select at least one Mapping Zone.
                            </span>
                        @enderror

                        <div class="edit-datum">
                            <div class="datum">Datum</div>
                            <div class="datum-value">{{ $form->datum }}</div>
                        </div>

                        <x-wrats-basic-text-input
                            label="Adjudication Boundary Link"
                            id="boundary_link"
                            wire:model="form.adjudication_boundary_map_link"
                            :disabled="!$isEditable"
                            tooltipContent="{{ config('tooltip-config.adjudication.adjudication_boundary_map_link') }}"
                        />
                        @error('form.adjudication_boundary_map_link')
                            <span class="text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <hr />
                        <div x-show="!isEditable">
                            <div class="edit-form-message my-3">
                                <i class="bi bi-info-circle"></i>
                                Now you are in view only mode. If you want to do
                                edits clicking on “Edit” button.
                            </div>
                            <button
                                type="button"
                                class="btn btn-outline-success filter-button"
                                x-on:click="$wire.toggleEdit"
                            >
                                Edit Form
                            </button>
                        </div>
                        <div class="row my-2 mx-1" x-show="isEditable">
                            <div class="col-6">
                                <button
                                    class="btn btn-grey w-100"
                                    type="button"
                                    wire:click="setEditableAndResetForm"
                                    wire:confirm="Are you sure you want to navigate away from this form? Your progress will be lost."
                                >
                                    Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button
                                    type="button"
                                    class="btn btn-green btn-w-100"
                                    wire:click="submit"
                                    wire:confirm="Are you sure you want to save these changes?"
                                >
                                    <div class="d-flex align-items-center">
                                        Save Changes
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
