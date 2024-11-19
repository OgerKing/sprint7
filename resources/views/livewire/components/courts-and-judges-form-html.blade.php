<div>
    <form wire:submit.prevent="save">
        <div
            id="caj-form"
            x-data="{
                courtType: @entangle('form.court_type'),
            }"
        >
            <div class="row my-3">
                <div class="col-md-6">
                    <div
                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                    >
                        <label class="input-label">Court Type</label>
                        <select
                            wire:model="form.court_type"
                            wire:change="courtTypeChanged"
                            class="btn dropdown-toggle form-styles"
                        >
                            <option disabled value="">
                                Select an option...
                            </option>

                            @foreach ($courtTypeOptions as $option)
                                <option value="{{ $option['value'] }}">
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @error('form.court_type')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6" x-show="courtType === 'State'">
                    <div
                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                    >
                        <div
                            class="input-label-with-tooltip d-flex align-items-center"
                        >
                            District

                            <x-wrats-tooltip
                                tooltipContent="{{ config('tooltip-config.adjudication_courts.court') }}"
                            />
                        </div>
                        <select
                            wire:model.live="form.court_id"
                            wire:change="loadDistrictJudgesByCourt()"
                            class="btn dropdown-toggle form-styles"
                        >
                            <option disabled :value="null">
                                Select an option...
                            </option>

                            @foreach ($stateCourtOptions as $option)
                                <option value="{{ $option['value'] }}">
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @error('form.court_id')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div
                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select mt-3"
                    >
                        <div
                            class="input-label-with-tooltip d-flex align-items-center"
                        >
                            District Judge
                            <x-wrats-tooltip
                                tooltipContent="{{ config('tooltip-config.adjudication_courts.judge_name') }}"
                            />
                        </div>
                        <select
                            wire:model="form.court_judge_id"
                            class="btn dropdown-toggle form-styles"
                        >
                            <option :value="null" disabled>
                                Select an option...
                            </option>

                            @foreach ($courtPersonnelOptions as $option)
                                <option value="{{ $option['value'] }}">
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.court_judge_id')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="file-upload-component">
                        <label for="court_judge_signature">
                            Drop signature file here or browse. Supports JPEG,
                            PNG, GIF.
                        </label>
                        <input
                            type="file"
                            class="form-control-file"
                            id="court_judge_signature"
                            wire:model="form.court_judge_signature"
                        />
                        @if ($courtCase?->court_judge_signature)
                            Existing Signature:
                            <img src="{{ $courtCase->court_judge_signature }}" alt="signature" class="img-fluid" />
                            <button
                                type="button"
                                class="btn btn-grey btn-sm"
                                wire:confirm="Are you sure want to delete this signature?"
                                wire:click="deleteJudgeSignature({{ $courtCase->id }})"
                            >Delete Signature</button>
                        @endif
                    </div>

                    <div>
                        @error('form.court_judge_id')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror

                        @error('form.court_judge_signature')
                        <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3" x-show="courtType === 'Federal'">
                <div class="col-md-6">
                    <div
                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                    >
                        <div
                            class="input-label-with-tooltip d-flex align-items-center"
                        >
                            Federal Judge
                            <x-wrats-tooltip
                                tooltipContent="{{ config('tooltip-config.adjudication_courts.judge_name') }}"
                            />
                        </div>
                        <select
                            wire:model="form.court_judge_id"
                            class="btn dropdown-toggle form-styles"
                        >
                            <option disabled :value="null">
                                Select an option...
                            </option>

                            @foreach ($federalJudgeOptions as $option)
                                <option value="{{ $option['value'] }}">
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="file-upload-component">
                        <label for="court_judge_signature">
                            Drop signature file here or browse. Supports JPEG,
                            PNG, GIF.
                        </label>
                        <input
                            type="file"
                            class="form-control-file"
                            id="court_judge_signature"
                            wire:model="form.court_judge_signature"
                        />
                        @if ($courtCase?->court_judge_signature)
                            Existing Signature:
                            <img src="{{ $courtCase->court_judge_signature }}" alt="signature" class="img-fluid" />

                            <button
                                    type="button"
                                    class="btn btn-grey btn-sm"
                                    wire:confirm="Are you sure want to delete this signature?"
                                    wire:click="deleteJudgeSignature({{ $courtCase->id }})"
                            >Delete Signature</button>
                        @endif
                    </div>
                    <div>
                        @error('form.court_judge_id')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror

                        @error('form.court_judge_signature')
                        <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                    >
                        <div
                            class="input-label-with-tooltip d-flex align-items-center"
                        >
                            Court Magistrate/Master
                        </div>
                        <select
                            wire:model.live="form.court_master_id"
                            class="btn dropdown-toggle form-styles"
                        >
                            <option disabled value="">
                                Select an option...
                            </option>

                            @foreach ($courtMasterOptions as $option)
                                <option value="{{ $option['value'] }}">
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="file-upload-component">
                        <label for="court_master_signature">
                            Drop signature file here or browse. Supports JPEG,
                            PNG, GIF.
                        </label>
                        <input
                            type="file"
                            class="form-control-file"
                            id="court_master_signature"
                            wire:model="form.court_master_signature"
                        />

                        @if ($courtCase?->court_master_signature)
                            Existing Signature:
                            <img src="{{ $courtCase->court_master_signature }}" alt="signature" class="img-fluid" />

                            <button
                                    type="button"
                                    class="btn btn-grey btn-sm"
                                    wire:confirm="Are you sure want to delete this signature?"
                                    wire:click="deleteMasterSignature({{ $courtCase->id }})"
                            >Delete Signature</button>
                        @endif
                    </div>
                    <div>
                        @error('form.court_master_id')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror

                        @error('form.court_master_signature')
                        <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div
                    class="dropdown menu-options form-floating"
                    id="adjudication-status-dropdown-select"
                    x-data="{
                        adjSectionsFormCopy: @entangle('adjSectionsFormCopy'),
                    }"
                >
                    <label for="dropdownMenuButton" class="input-label">
                        Adjudication Section(s)
                    </label>
                    <button
                        class="btn dropdown-toggle form-styles"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        color="transparent"
                    >
                        Adjudication Section(s)
                    </button>

                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdown"
                    >
                        @foreach ($adjudicationSectionsOptions as $option)
                            <li
                                wire:key="status-option-{{ $option['value'] }}"
                            >
                                <div class="dropdown-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="recordTypes[]"
                                            id="{{ Str::slug($option['label']) }}"
                                            value="{{ intval($option['value']) }}"
                                            x-model="adjSectionsFormCopy"
                                            wire:change="selectSections('{{ intval($option['value']) }}')"
                                            wire:key="status-option-{{ intval($option['value']) }}"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="{{ Str::slug($option['label']) }}"
                                        >
                                            {{ $option['value'] }}
                                            {{ $option['label'] }}
                                        </label>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @foreach ($adjSectionsChips as $sectionBadge)
                    <span
                        class="badge CAJ-form badge-pill badge-primary mt-2 mx-1"
                    >
                        {{ $sectionBadge }}
                    </span>
                @endforeach

                <div>
                    @error('form.adjudication_sections')
                        <span class="error text-danger inline-error-msg">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6">
                    <x-wrats-text-area
                        class="form-control"
                        label="Case Name"
                        id="case-name"
                        rows="3"
                        wire:model="form.case_name"
                        tooltipContent="{{(config('tooltip-config.adjudication_courts.case_number')) }}"
                    ></x-wrats-text-area>
                    <div>
                        @error('form.case_name')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <x-wrats-basic-text-input
                        label="Case Number"
                        id="case-number"
                        wire:model="form.case_number"
                        tooltipContent="{{(config('tooltip-config.adjudication_courts.case_number')) }}"
                    />
                    <div>
                        @error('form.case_number')
                            <span class="error text-danger inline-error-msg">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <x-wrats-basic-text-input
                    label="Docket Link"
                    id="adjudication_section_name"
                    wire:model="form.court_docket_link"
                    tooltipContent="{{(config('tooltip-config.adjudication_courts.court_docket_link')) }}"
                />
                <div>
                    @error('form.court_docket_link')
                        <span class="error text-danger inline-error-msg">
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
                    wire:click="resetCourtsAndJudgesFields"
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
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
