<div>
    <div class="card" x-show="! $wire.showPlaceholder">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
                This is an example of a card component for the skeleton loader
            </p>
            <button class="btn btn-primary" wire:click="loading">
                Show Loading Component
            </button>
        </div>
    </div>

    <div class="card" aria-hidden="true" x-show="$wire.showPlaceholder">
        <div class="card-body">
            <h5 class="card-title placeholder-glow">
                <span class="placeholder col-6"></span>
            </h5>
            <p class="card-text placeholder-glow">
                <span class="placeholder col-7"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-6"></span>
                <span class="placeholder col-8"></span>
            </p>
            <a
                class="btn btn-primary disabled placeholder col-6"
                aria-disabled="true"
            ></a>
        </div>
    </div>
</div>

@script
    <script>
        Livewire.on('reset-placeholder', ({ delay }) => {
            console.log('inside reset placeholder');
            setInterval(() => {
                $wire.hidePlaceholder();
            }, 2000);
        });
    </script>
@endscript
