@props(['tooltipContent' => null])

<div class="relative inline-block wrats-tooltip">
    <i
        {{ $attributes }}
        class="bi bi-info-circle ms-2 relative text-red-500 transition cursor-pointer peer hover:text-red-700"
    ></i>
    <div class="tooltip-content">
        <span>{{ $tooltipContent }}</span>
    </div>
</div>
