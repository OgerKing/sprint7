<div
    id="adjudication-document-management-form"
    class="document-management-forms px-5 pb-5"
    x-data="{
        isEditable: @entangle('isEditable'),
        hasAttachment: @entangle('hasAttachment'),
    }"
>
    <div class="row mb-3 pt-5 pb-2">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <i class="bi bi-arrow-left-short"></i>

                    <li class="breadcrumb-item">
                        <a
                            x-data="{ isEditable: @entangle('isEditable') }"
                            href="/records"
                            @click.prevent="if (isEditable) {
            if (confirm('Are you sure you want to navigate away? You will lose your progress.')) {
                window.location.href = '/records';
            }
        } else {
            window.location.href = '/records';
        }"
                        >
                            Records
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Documents
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Adjudication Document
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <form wire:submit.prevent="save">
        <!-- Document Title and Menu Dropdown -->
        <div class="row">
            <div class="d-flex justify-content-between mb-3">
                <div class="header">
                    <span class="document">Document:</span>
                    <span class="document-title">
                        {{ $this->form->adjudication_document_title }}
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <button
                        x-show="isEditable"
                        class="btn btn-grey mx-1"
                        type="button"
                        type="reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"
                        wire:click="cancel()"
                        wire:confirm="Are you sure you want to cancel? Your progress will be lost."
                    >
                        Cancel
                    </button>
                    <button
                        x-show="isEditable"
                        class="btn btn-green mx-1"
                        type="button"
                        wire:click="save"
                        wire:confirm="Are you sure you want to save these changes?"
                        wire:loading.attr="disabled"
                        wire:target="form.attachment_URL"
                    >
                        Save Edits
                    </button>

                    <div class="dropdown mx-1">
                        <!-- Trigger dropdown -->
                        <i
                            class="bi bi-three-dots-vertical btn btn-outline-dark"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="cursor: pointer"
                        ></i>

                        <!-- Dropdown menu -->
                        <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="#"
                                    x-on:click="$wire.toggleEdit"
                                >
                                    <i class="bi bi-pencil"></i>
                                    <span class="li-label">Edit Details</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Document Form and Image Preview Card -->
            <div>
                <div class="card doc-management-adjudication">
                    <div class="card-body row">
                        <div
                            class="col-md-5 doc-management-adjudication-form-column"
                        >
                            <div>
                                <div
                                    id="adjudication-document-form"
                                    x-data="{
                                        editForm: @entangle('editForm'),
                                    }"
                                >
                                    <div class="row card-columns">
                                        <div
                                            class="col-md-12 adjudication-document-columns"
                                        >
                                            <div>
                                                <div class="my-4">
                                                    <div
                                                        class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select my-3"
                                                    >
                                                        <div
                                                            class="input-label-with-tooltip d-flex align-items-center"
                                                        >
                                                            Subfile
                                                        </div>
                                                        <select
                                                            wire:model="form.subfile_id"
                                                            class="btn dropdown-toggle form-styles"
                                                            @if(!$isEditable) disabled @endif
                                                        >
                                                            <option
                                                                disabled
                                                                value=""
                                                            >
                                                                Select an
                                                                option...
                                                            </option>

                                                            @foreach ($subfileOptions as $option)
                                                                <option
                                                                    value="{{ $option['value'] }}"
                                                                >
                                                                    {{ $option['label'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('form.subfile_id')
                                                        <span
                                                            class="error text-danger inline-error-msg"
                                                        >
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="my-4"></div>
                                                <x-wrats-basic-text-input
                                                    label="Document Code"
                                                    id="dd-title"
                                                    :disabled="!$isEditable"
                                                    wire:model="form.adjudication_document_code"
                                                    tooltipContent="{{ config('tooltip-config.adjudication_document.adjudication_document_code') }}"
                                                />
                                                @error('form.adjudication_document_code')
                                                    <span
                                                        class="error text-danger inline-error-msg"
                                                    >
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="my-4">
                                                <x-wrats-basic-text-input
                                                    label="Document Title"
                                                    id="dd-title"
                                                    :disabled="!$isEditable"
                                                    wire:model="form.adjudication_document_title"
                                                    tooltipContent="{{ config('tooltip-config.adjudication_document.adjudication_document_title') }}"
                                                />
                                                @error('form.adjudication_document_title')
                                                    <span
                                                        class="error text-danger inline-error-msg"
                                                    >
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div>
                                                <div
                                                    class="input-wrapper date-range-div"
                                                >
                                                    <div
                                                        class="dropdown menu-options form-floating date-range-picker-container"
                                                    >
                                                        <label
                                                            for="datePickerDefendant"
                                                            class="input-label"
                                                        >
                                                            Select Date
                                                        </label>
                                                        <div
                                                            class="input-group"
                                                        >
                                                            <input
                                                                @if(!$isEditable) disabled @endif
                                                                id="datePickerDefendant"
                                                                class="date-range-input form-styles"
                                                                type="text"
                                                                name="date"
                                                                wire:model="form.document_filing_date"
                                                                x-data
                                                                x-init="$('#datePickerDefendant').daterangepicker({
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

                $('#datePickerDefendant').val(formattedDate); // Set the formatted date in the picker
            } else {
                $('#datePickerDefendant').val(''); // Leave empty if there's no date
            }
                                                                        "
                                                            />
                                                            <span
                                                                class="input-group-text calendar-icon"
                                                            >
                                                                <i
                                                                    class="bi bi-calendar"
                                                                ></i>
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
                                            <div class="my-4">
                                                <div
                                                    class="dropdown ua-dropdown-select menu-options form-floating wrats-dropdown-select my-3"
                                                >
                                                    <div
                                                        class="input-label-with-tooltip d-flex align-items-center"
                                                    >
                                                        Document Type
                                                        <x-wrats-tooltip
                                                            tooltipContent="{{ config('tooltip-config.adjudication_document.adjudication_document_type_id') }}"
                                                        />
                                                    </div>
                                                    <select
                                                        wire:model="form.document_type_id"
                                                        class="btn dropdown-toggle form-styles"
                                                        @if(!$isEditable) disabled @endif
                                                    >
                                                        <option
                                                            disabled
                                                            value=""
                                                        >
                                                            Select an option...
                                                        </option>

                                                        @foreach ($documentTypeOptions as $option)
                                                            <option
                                                                value="{{ $option['value'] }}"
                                                            >
                                                                {{ $option['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('form.document_type_id')
                                                    <span
                                                        class="error text-danger inline-error-msg"
                                                    >
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <hr />

                                            <div
                                                class="my-4"
                                                x-show="hasAttachment"
                                            >
                                                <div
                                                    class="attachment-label mb-1"
                                                >
                                                    Document Attachment
                                                </div>
                                                <div class="input-group">
                                                    <div
                                                        class="input-group-prepend"
                                                    >
                                                        <span
                                                            class="input-group-text"
                                                            id="basic-addon1"
                                                        >
                                                            <i
                                                                class="bi bi-paperclip"
                                                            ></i>
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
                                                    x-show="isEditable"
                                                    class="upload-new"
                                                    wire:click="hasAttachment = null"
                                                >
                                                    Upload New File
                                                </a>
                                            </div>

                                            <div
                                                class="mb-3"
                                                x-show="!hasAttachment"
                                            >
                                                <div
                                                    class="attachment-label mb-1"
                                                >
                                                    Document Attachment
                                                </div>
                                                <input
                                                    @if(!$isEditable) disabled @endif
                                                    class="form-control"
                                                    type="file"
                                                    id="attachment_URL"
                                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                                    wire:model="form.attachment_URL"
                                                />
                                                <div
                                                    wire:loading
                                                    wire:target="form.attachment_URL"
                                                >
                                                    Uploading...
                                                </div>
                                                <a
                                                    x-show="isEditable"
                                                    class="upload-new"
                                                    wire:click="resetAttachmentURL"
                                                >
                                                    Cancel
                                                </a>
                                            </div>
                                            @error('form.attachment_URL')
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
                            </div>
                        </div>
                        <!-- Image Preview Column -->
                        <!-- File Preview Column -->
                        <div class="col-md-7">
                            <div class="file-preview image-preview">
                                <div
                                    class="file-preview image-preview d-flex align-items-center justify-content-center"
                                >
                                    @if ($form->attachment_URL)
                                        @if (Str::endsWith($form->attachment_URL, ['jpg', 'jpeg', 'png']))
                                            <img
                                                src="{{ asset($form->attachment_URL) }}"
                                                alt="image-preview"
                                                class="img-fit"
                                            />
                                        @elseif (Str::endsWith($form->attachment_URL, ['pdf']))
                                            <iframe
                                                src="{{ asset($form->attachment_URL) }}"
                                                width="100%"
                                                height="100%"
                                            ></iframe>
                                        @else
                                            <a
                                                href="{{ asset($form->attachment_URL) }}"
                                                target="_blank"
                                            >
                                                Download Attachment
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
