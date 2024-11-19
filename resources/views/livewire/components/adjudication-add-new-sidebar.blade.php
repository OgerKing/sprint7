<div id="adjudication-add-sidebar">
    <div>
        <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="offcanvasExampleAdd"
            aria-labelledby="offcanvasExampleLabel"
            x-data="{
                isOpen: @entangle('isOpen'),
                mapping_zone_west: @entangle('mapping_zone_west'),
                mapping_zone_east: @entangle('mapping_zone_east'),
                mapping_zone_central: @entangle('mapping_zone_central'),
            }"
            wire:ignore.self
            data-bs-backdrop="static"
            data-bs-keyboard="false"
        >
            <div class="offcanvas-header pb-0">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    Add New Adjudication
                </h5>
                <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                    wire:click="resetAddAdjudicationFields"
                    @click="isOpen = false"
                ></button>
            </div>

            <hr />

            <div class="offcanvas-body">
                @if ($submissionSuccess)
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @else
                    <form wire:submit.prevent="submit">
                        <div class="my-4">
                            <x-wrats-basic-text-input
                                label="Title"
                                id="title-add"
                                wire:model="form.adjudication_name"
                                tooltipContent="{{(config('tooltip-config.adjudication.adjudication_name')) }}"
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
                                tooltipContent="{{(config('tooltip-config.adjudication.prefix')) }}"
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
                                tooltipContent="{{(config('tooltip-config.adjudication.adjudication_nickname')) }}"
                            />
                            @error('form.adjudication_nickname')
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
                                    Status
                                    <x-wrats-tooltip
                                        tooltipContent="{{ config('tooltip-config.adjudication.adjudication_status') }}"
                                    />
                                </div>
                                <select
                                    wire:model="form.adjudication_status_id"
                                    class="btn dropdown-toggle form-styles"
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

                        <div class="mapping-title">Mapping Zones</div>

                        <div class="d-flex justify-content-between">
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    value="West"
                                    wire:model="form.mapping_zone_west"
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
                                    value="Central"
                                    wire:model="form.mapping_zone_central"
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
                                    value="East"
                                    wire:model="form.mapping_zone_east"
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
                            <div class="datum-value">NAD 27</div>
                        </div>
                        <div class="my-4">
                            <x-wrats-basic-text-input
                                label="Adjudication Boundary Link"
                                id="boundary_link"
                                wire:model="form.adjudication_boundary_map_link"
                                tooltipContent="{{(config('tooltip-config.adjudication.adjudication_boundary_map_link')) }}"
                            />
                            @error('form.adjudication_boundary_map_link')
                                <span class="text-danger inline-error-msg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <hr />
                        <div class="row my-2 mx-1">
                            <div class="col-6">
                                <button
                                    class="btn btn-grey w-100"
                                    type="button"
                                    type="reset"
                                    data-bs-dismiss="offcanvas"
                                    aria-label="Close"
                                    wire:click="$dispatch('resetAddAdjudicationFields')"
                                    wire:confirm="Are you sure you want to navigate away from this form? Your progress will be lost."
                                >
                                    Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button
                                    class="btn btn-green btn-w-100"
                                    type="button"
                                    wire:click="submit"
                                    wire:confirm="Are you sure you want to save these changes?"
                                >
                                    Add Adjudication
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
