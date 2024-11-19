<div>
    <form wire:submit.prevent="save">
        <div
            class="card-body"
            id="global-document-form"
            x-data="{
                editForm: @entangle('editForm'),
                hasAttachment: @entangle('hasAttachment'),
            }"
        >
            <div class="row card-columns">
                <div
                    class="col-md-6 global-document-columns current-adjudication"
                >
                    @if ($globalDocumentType === 'Subfiles')
                        <div class="column-heading">Selected Subfiles</div>

                        <div class="selected-adjudication">
                            @foreach ($this->selectedSubfiles as $subfile)
                                <div class="subfile-item">
                                    {{ $subfile->formatted_subfile_name }}
                                </div>
                            @endforeach
                        </div>
                    @elseif ($globalDocumentType === 'Adjudication')
                        <div class="column-heading">Selected Adjudication</div>

                        <div class="selected-adjudication">
                            {{ $adjudication->adjudication_name }}
                        </div>
                    @elseif ($globalDocumentType === 'Persons')
                        <div class="column-heading">Selected Persons</div>

                        <div class="selected-adjudication">
                            @foreach ($this->selectedPersons as $person)
                                <div class="subfile-item">
                                    {{ $person->first_name . ' ' . $person->last_name }}
                                </div>
                            @endforeach
                        </div>
                    @elseif ($globalDocumentType === 'Water Rights')
                        <div class="column-heading">Selected Water Rights</div>

                        <div class="selected-adjudication">
                            @foreach ($this->selectedWaterRights as $right)
                                <div class="subfile-item">
                                    {{ $right->id }}
                                </div>
                            @endforeach
                        </div>
                    @elseif ($globalDocumentType === 'Places of Use')
                        <div class="column-heading">Selected Places of Use</div>

                        <div class="selected-adjudication">
                            @foreach ($this->selectedPlacesOfUse as $pou)
                                <div class="subfile-item">
                                    {{ $pou->id }}
                                </div>
                            @endforeach
                        </div>
                    @elseif ($globalDocumentType === 'Points of Diversion')
                        <div class="column-heading">
                            Selected Points of Diversion
                        </div>

                        <div class="selected-adjudication">
                            @foreach ($this->selectedPointsOfDiversion as $pod)
                                <div class="subfile-item">
                                    {{ $pod->id }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-6 global-document-columns form-column">
                    <div class="mb-4 column-heading">Upload Document</div>

                    <div>
                        <div class="column-heading">Add Attachment</div>
                        <div class="my-4" x-show="hasAttachment">
                            <div class="attachment-label mb-1">
                                Document Attachment
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                    >
                                        <i class="bi bi-paperclip"></i>
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    aria-describedby="basic-addon1"
                                    wire:model="form.attachment_file_path"
                                    disabled
                                />
                            </div>
                            <a
                                class="upload-new"
                                wire:click="hasAttachment = null"
                            >
                                Upload New File
                            </a>
                        </div>

                        <div class="mb-3" x-show="!hasAttachment">
                            <div class="attachment-label mb-1">
                                Document Attachment
                            </div>
                            <input
                                class="form-control"
                                type="file"
                                id="attachment_URL"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                wire:model="form.attachment_URL"
                            />
                            <div wire:loading wire:target="form.attachment_URL">
                                Uploading...
                            </div>
                            <a
                                class="upload-new"
                                wire:click="resetAttachmentURL"
                            >
                                Cancel
                            </a>
                        </div>
                    </div>
                    <hr />
                    <div>
                        <div class="my-4 column-heading">
                            Document Information
                        </div>
                        <div class="my-4">
                            <x-wrats-basic-text-input
                                label="Document Title"
                                id="gd-title"
                                wire:model="form.global_document_title"
                                tooltipContent="{{ config('tooltip-config.global_documents.global_title') }}"
                            />
                            @error('form.global_document_title')
                                <span
                                    class="error text-danger inline-error-msg"
                                >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <div
                                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select my-3"
                            >
                                <div
                                    class="input-label-with-tooltip d-flex align-items-center"
                                >
                                    Document Category
                                </div>
                                <select
                                    wire:model="form.global_document_category"
                                    class="btn dropdown-toggle form-styles"
                                    disabled
                                >
                                    <option disabled value="">
                                        Select an option...
                                    </option>

                                    @foreach ($documentCategoryOptions as $option)
                                        <option value="{{ $option['value'] }}">
                                            {{ $option['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('form.global_document_category')
                                <span
                                    class="error text-danger inline-error-msg"
                                >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <div
                                class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select my-3"
                            >
                                <div
                                    class="input-label-with-tooltip d-flex align-items-center"
                                >
                                    Document Type
                                    <x-wrats-tooltip
                                        tooltipContent="{{ config('tooltip-config.global_documents.global_document_type_id') }}"
                                    />
                                </div>
                                <select
                                    wire:model="form.global_document_type_id"
                                    class="btn dropdown-toggle form-styles"
                                >
                                    <option disabled value="">
                                        Select an option...
                                    </option>

                                    @foreach ($documentTypeOptions as $option)
                                        <option value="{{ $option['value'] }}">
                                            {{ $option['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('form.global_document_type_id')
                                <span
                                    class="error text-danger inline-error-msg"
                                >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <x-wrats-basic-text-input
                                label="Docket ID"
                                id="gd-title"
                                wire:model="form.docket_id"
                                maxLength="10"
                                tooltipContent="{{ config('tooltip-config.global_documents.docket_id') }}"
                            />
                            @error('form.docket_id')
                                <span
                                    class="error text-danger inline-error-msg"
                                >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="my-4">
                            <x-wrats-text-area
                                class="form-control"
                                label="Global Document Description"
                                id="global-desc"
                                rows="3"
                                wire:model="form.global_desc"
                                tooltipContent="{{(config('tooltip-config.global_documents.global_desc')) }}"
                            ></x-wrats-text-area>
                            <div>
                                @error('form.global_desc')
                                    <span
                                        class="error text-danger inline-error-msg"
                                    >
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <div class="input-wrapper date-range-div">
                            <div
                                class="dropdown menu-options form-floating date-range-picker-container"
                            >
                                <label
                                    for="datePickerGlobal"
                                    class="input-label"
                                >
                                    Select Date
                                </label>
                                <div class="input-group">
                                    <input
                                        id="datePickerGlobal"
                                        class="date-range-input form-styles"
                                        type="text"
                                        name="date"
                                        wire:model="form.document_filing_date"
                                        x-data
                                        x-init="$('#datePickerGlobal').daterangepicker({
                                                                        singleDatePicker: true,
                                                                        showDropdowns: true,
                                                                        autoUpdateInput: false,
                                                                        drops: 'up',
                                                                        opens: 'left',
                                                                        locale: {
                                                                            format: 'YYYY-MM-DD HH:mm:ss'},
                                                                        },
                                                                        function (chosen_date) {
                                                                            @this.set('form.document_filing_date', chosen_date.format('YYYY-MM-DD HH:mm:ss'));
                                                                        }
                                                                        );
                                                                        // If there's a date, format and set it; otherwise, leave it empty
                                                                         if (@this.form.document_filing_date) {
                let formattedDate = moment(@this.form.document_filing_date, 'YYYY-MM-DD HH:mm:ss').isValid()
                    ? moment(@this.form.document_filing_date, 'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY') 
                    : '';

                $('#datePickerGlobal').val(formattedDate); // Set the formatted date in the picker
            } else {
                $('#datePickerGlobal').val(''); // Leave empty if there's no date
            }
                                                                        "
                                    />
                                    <span
                                        class="input-group-text calendar-icon"
                                    >
                                        <i class="bi bi-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            @error('form.document_filing_date')
                                <span
                                    class="error text-danger inline-error-msg"
                                >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </div>
        <div class="card-footer global-document-card-footer">
            <div class="row my-2 mx-1">
                <div class="col-6">
                    <button
                        class="btn btn-grey w-100"
                        type="button"
                        aria-label="Close"
                        wire:click="resetDocumentsFields"
                        wire:confirm="Are you sure you want to exit this form? Your progress will be lost."
                    >
                        Cancel
                    </button>
                </div>
                @if ($editForm)
                    <div class="col-6">
                        <button class="btn btn-green btn-w-100" type="submit">
                            Edit Document
                        </button>
                    </div>
                @else
                    <div class="col-6">
                        <button
                            class="btn btn-green btn-w-100"
                            type="button"
                            wire:click="save"
                            wire:confirm="Are you sure you want to save these changes?"
                        >
                            Add Document to {{ $globalDocumentType }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
