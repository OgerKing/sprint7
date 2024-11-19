<div class="dropdown ua-dropdown-select menu-options form-floating">
    <label for="{{ $id }}" class="input-label">
        {{ $label }}
    </label>
    <button
        class="btn dropdown-toggle form-styles"
        type="button"
        id="{{ $id }}"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        color="transparent"
    >
        {{ $selectedItemLabel }}
    </button>

    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $id }}">
        @foreach ($options as $option)
            <li wire:key="bureau-option-{{ $id }}">
                <a
                    class="dropdown-item @if($selectedItem == $option['value']) active @endif"
                    href="#"
                    wire:click.prevent="selectOption('{{ $option['value'] }}', '{{ $option['label'] }}')"
                    onclick="event.stopPropagation();"
                >
                    {{ $option['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
