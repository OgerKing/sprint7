<div id="combine-view">
    <div class="row mb-3 pt-5 pb-2 mx-4 px-4">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <i class="bi bi-arrow-left-short"></i>

                    <li class="breadcrumb-item">
                        <a wire:navigate href="/adjudications">Adjudications</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Combine Adjudications
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div
        class="container combine-container"
        x-data="{
            step: @entangle('step'),
            understood: @entangle('understood'),
        }"
    >
        <div class="combine-card pt-3">
            <div class="card">
                <div class="card-header">Combine Adjudication</div>
                <section x-show="step == 1">
                    <div class="card-body">
                        <div class="mb-4">Available Adjudications</div>
                        <div class="mb-3">
                            <div class="form-check custom-radio">
                                @if ($adjudication)
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="adjudication_id-default"
                                        value="{{ $adjudication['id'] }}"
                                        checked
                                    />
                                    <label class="form-check-label mx-2">
                                        {{ $adjudication->adjudication_name }}
                                    </label>
                                @endif
                            </div>
                            <label for="radioGroup" class="form-label"></label>
                            <div id="radioGroup">
                                @foreach ($availableAdjudications as $adjudication)
                                    <div class="my-2">
                                        <div class="form-check custom-radio">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="radio{{ $adjudication->id }}"
                                                name="adjudication_id"
                                                value="{{ $adjudication->id }}"
                                                wire:model.live="selectedAdjudicationId"
                                            />
                                            <label
                                                class="form-check-label mx-2"
                                                for="radio{{ $adjudication->id }}"
                                            >
                                                {{ $adjudication->adjudication_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button
                                    class="btn btn-green btn-w-100"
                                    @disabled(!$selectedAdjudicationId)
                                    wire:click.prevent="nextStep"
                                >
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <section x-show="step == 2">
                    <form wire:submit.prevent="submit">
                        <div class="card-body">
                            <div class="px-5 mx-5 mt-5">
                                Create the New Adjudication
                            </div>
                            <div class="row px-5 mx-5 mt-4">
                                <div class="my-2">
                                    <x-wrats-basic-text-input
                                        label="Title"
                                        id="title"
                                        wire:model="form.adjudication_name"
                                        tooltipContent="Title of the Adjudication"
                                    />
                                    @error('form.adjudication_name')
                                        <span
                                            class="text-danger inline-error-msg"
                                        >
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <x-wrats-basic-text-input
                                        class="my-2"
                                        label="Adjudication Prefix"
                                        id="prefix"
                                        wire:model="form.prefix"
                                        maxLength="10"
                                        tooltipContent="Parent level basin code of the adjudication sections' basins where applicable."
                                    />
                                    @error('form.prefix')
                                        <span
                                            class="text-danger inline-error-msg"
                                        >
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <x-wrats-basic-text-input
                                        class="my-2"
                                        label="Nickname"
                                        id="nickname"
                                        wire:model="form.adjudication_nickname"
                                        tooltipContent="Short name of the Adjudication - optional"
                                    />
                                    @error('form.adjudication_nickname')
                                        <span
                                            class="text-danger inline-error-msg"
                                        >
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <div
                                        id="parent-section"
                                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                                    >
                                        <label class="input-label">
                                            Status
                                        </label>
                                        <select
                                            wire:model="form.adjudication_status_id"
                                            class="btn dropdown-toggle form-styles"
                                        >
                                            <option disabled value="">
                                                Select an option...
                                            </option>
                                            <option value="">None</option>

                                            @foreach ($statusOptions as $option)
                                                <option
                                                    value="{{ $option['value'] }}"
                                                >
                                                    {{ $option['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('form.adjudication_status_id')
                                        <span
                                            class="text-danger inline-error-msg"
                                        >
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <div
                                        id="parent-section"
                                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select"
                                    >
                                        <label class="input-label">
                                            Bureau
                                        </label>
                                        <select
                                            wire:model="form.bureau_id"
                                            class="btn dropdown-toggle form-styles"
                                        >
                                            <option disabled value="">
                                                Select an option...
                                            </option>
                                            <option value="">None</option>

                                            @foreach ($bureauOptions as $option)
                                                <option
                                                    value="{{ $option['value'] }}"
                                                >
                                                    {{ $option['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('form.bureau_id')
                                        <span
                                            class="text-danger inline-error-msg"
                                        >
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <x-wrats-basic-text-input
                                        label="Adjudication Boundary Link"
                                        id="boundary_link"
                                        wire:model="form.adjudication_boundary_map_link"
                                    />
                                    @error('form.adjudication_boundary_map_link')
                                        <span
                                            class="text-danger inline-error-msg"
                                        >
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row my-2 mx-1">
                                <div class="col-6">
                                    <button
                                        class="btn btn-grey w-100"
                                        type="button"
                                        type="reset"
                                        aria-label="Close"
                                        wire:click.prevent="previousStep"
                                    >
                                        Previous
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button
                                        class="btn btn-green btn-w-100"
                                        wire:click.prevent="nextStepValidate"
                                    >
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>

                <section data-step="3. Social" x-show="step == 3">
                    <div class="card-body d-flex align-items-center">
                        <div class="row">
                            <div class="col-md-6 combine-warning">
                                <div class="card px-4 py-4">
                                    <div class="text-danger">
                                        Combine Adjudication?
                                    </div>
                                    <p>
                                        Are you sure you want to combine
                                        <strong>
                                            {{ $adjudication->adjudication_name }}
                                        </strong>
                                        and
                                        <strong>
                                            {{ $this->selectedAdjudication ? $this->selectedAdjudication->adjudication_name : '' }}
                                        </strong>
                                    </p>
                                    <p>
                                        1. All Subfiles information including
                                        person, doucments, notes, claims and
                                        rights related to these adjudications
                                        will be moved to
                                        <strong>
                                            {{ $form->adjudication_name }}
                                        </strong>
                                    </p>
                                    <p>
                                        2. All global documents will be moved to
                                        <strong>
                                            {{ $form->adjudication_name }}
                                        </strong>
                                    </p>

                                    <div>
                                        <input
                                            type="checkbox"
                                            id="understood"
                                            wire:model="understood"
                                            class="form-check-input"
                                        />
                                        <label
                                            for="understood"
                                            class="form-check-label"
                                        >
                                            I understand
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row my-2 mx-1">
                            <div class="col-6">
                                <button
                                    class="btn btn-grey w-100"
                                    type="button"
                                    type="reset"
                                    aria-label="Close"
                                    wire:click.prevent="previousStep"
                                >
                                    Previous
                                </button>
                            </div>
                            <div class="col-6">
                                <button
                                    class="btn btn-green btn-w-100"
                                    :disabled="!understood"
                                    wire:click="save"
                                    wire:confirm="Are you sure you want to combine these Adjudications?"
                                >
                                    Combine Adjudications
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
