<div>
    <form wire:submit.prevent="save">
        <div class="row my-3">
            <div
                x-data="{ showParentDropdown: @entangle('showParentDropdown') }"
                x-show="showParentDropdown"
                id="parent-section"
                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
            >
                <div class="input-label-with-tooltip d-flex align-items-center">
                    Parent Section Name (if subsection)
                    <x-wrats-tooltip
                        tooltipContent="{{ config('tooltip-config.adjudication_sections.adjudication_section_name') }}"
                    />
                </div>
                <select
                    wire:model="form.adjudication_section_parent_id"
                    class="btn dropdown-toggle form-styles"
                >
                    <option disabled value="">Select an option...</option>
                    <option value="">None</option>

                    @foreach ($safeSubsectionParentList as $option)
                        <option value="{{ $option['value'] }}">
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-6">
                <x-wrats-basic-text-input
                    label="Section Name"
                    id="adjudication_section_name"
                    wire:model="form.adjudication_section_name"
                    tooltipContent="{{ config('tooltip-config.adjudication_sections.adjudication_section_name') }}"
                />
                <div>
                    @error('form.adjudication_section_name')
                        <span class="error text-danger inline-error-msg">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <x-wrats-basic-text-input
                    label="Prefix"
                    id="section-prefix"
                    wire:model="form.prefix"
                    maxLength="10"
                    tooltipContent="{{ config('tooltip-config.adjudication_sections.prefix') }}"
                />
                <div>
                    @error('form.prefix')
                        <span class="error text-danger inline-error-msg">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-6">
                <div
                    class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                >
                    <div
                        class="input-label-with-tooltip d-flex align-items-center"
                    >
                        Section Status

                        <x-wrats-tooltip
                            tooltipContent="{{ config('tooltip-config.adjudication_sections.adjudication_section_status') }}"
                        />
                    </div>
                    <select
                        wire:model="form.adjudication_section_status_id"
                        class="btn dropdown-toggle form-styles"
                    >
                        <option disabled value="">Select an option...</option>

                        @foreach ($adjudicationStatusList as $option)
                            <option value="{{ $option['value'] }}">
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    @error('form.adjudication_section_status_id')
                        <span class="error text-danger inline-error-msg">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <div
                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                    >
                        <div
                            class="input-label-with-tooltip d-flex align-items-center"
                        >
                            Section Type
                            <x-wrats-tooltip
                                tooltipContent="{{ config('tooltip-config.adjudication_sections.adjudication_section_type') }}"
                            />
                        </div>
                        <select
                            wire:model="form.adjudication_section_type_id"
                            class="btn dropdown-toggle form-styles"
                        >
                            <option disabled value="">
                                Select an option...
                            </option>

                            @foreach ($adjudicationSectionTypesList as $option)
                                <option value="{{ $option['value'] }}">
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('form.adjudication_section_type_id')
                        <span class="text-danger inline-error-msg">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-6">
                <x-wrats-basic-text-input
                    label="Boundary Name"
                    id="boundary-name"
                    wire:model="form.boundary_name"
                    tooltipContent="{{ config('tooltip-config.adjudication_sections.boundary_name') }}"
                />
                <div>
                    @error('form.boundary_name')
                        <span class="text-danger inline-error-msg">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="pb-2 mt-2" />
        <div class="row">
            <div class="col-md-6">
                <button
                    class="btn btn-grey w-100"
                    type="button"
                    wire:click="resetFields"
                    wire:confirm="Are you sure you want to navigate away from this form? Your progress will be lost."
                >
                    Cancel
                </button>
            </div>
            <div class="col-md-6">
                <button
                    class="btn btn-green btn-w-100"
                    type="button"
                    wire:click="save"
                    wire:confirm="Are you sure you want to save these changes?"
                >
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
