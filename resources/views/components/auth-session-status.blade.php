@props([
    'status',
])

@if ($status)
    <div
        id="alert-message"
        {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}
    >
        <div class="alert alert-success">
            {{ $status }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var alertElement = document.getElementById('alert-message');
            if (alertElement) {
                // Set a timeout to hide the alert after 3000ms
                setTimeout(function () {
                    alertElement.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endif
