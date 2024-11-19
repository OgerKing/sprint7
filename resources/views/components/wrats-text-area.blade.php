@props(['id' => '', 'label' => 'Test Label', 'defaultValue' => '', 'tooltipContent' => null])

<div class="form-floating wrats-text-area input-component position-relative">
    <textarea
        type="text"
        class="form-control form-styles basic-text-input"
        id="{{ $id }}"
        name="{{ $id }}"
        value="{{ $defaultValue }}"
        {{ $attributes }}
    ></textarea>
    <div class="input-label-with-tooltip d-flex align-items-center">
        {{ $label }}
        <x-wrats-tooltip tooltipContent="{{$tooltipContent}}" />
    </div>
    <div>
        @error($id)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const tooltipTriggerList = document.querySelectorAll(
    //         '[data-bs-toggle="tooltip"]',
    //     );
    //     const tooltipList = [...tooltipTriggerList].map(
    //         (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl),
    //     );
    // });
</script>
