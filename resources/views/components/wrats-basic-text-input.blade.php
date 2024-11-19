@props(['id' => '', 'label' => 'Test Label', 'defaultValue' => '', 'tooltipContent' => null])

<div class="form-floating input-component wrats-text-input position-relative">
    <input
        type="text"
        class="form-control form-styles basic-text-input"
        id="{{ $id }}"
        name="{{ $id }}"
        value="{{ $defaultValue }}"
        {{ $attributes }}
    />

    <div class="input-label-with-tooltip d-flex align-items-center">
        {{ $label }}
        @if ($tooltipContent)
            <x-wrats-tooltip tooltipContent="{{$tooltipContent}}" />
        @endif
    </div>

    <div>
        @error($id)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
