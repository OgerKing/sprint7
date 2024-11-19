<div>
    <div
        x-data="{
            show: @entangle('show'),
        }"
        x-init="setTimeout(() => (show = false), 5000)"
        x-show="show"
        @flash-message.window="show = true; setTimeout(() => show = false, 3000)"
        :class="{
            'snackbar-success': '{{ $type }}' === 'success',
            'snackbar-error': '{{ $type }}' === 'error',
            'snackbar-warning': '{{ $type }}' === 'warning',
            'snackbar-info': '{{ $type }}' === 'info'
        }"
        id="flash-message"
    >
        <div class="d-flex justify-content-between">
            <div class="message-title">{{ $messageTitle }}</div>
            <div
                class="close-message"
                @click="show = false"
                style="cursor: pointer"
            >
                <i class="bi bi-x"></i>
            </div>
        </div>
        <div class="message">{{ $message }}</div>
    </div>
</div>
