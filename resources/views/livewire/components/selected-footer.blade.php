<div>
    @if(count($selectedRows) > 0)
        <div class="selected-count-footer">
            <div>
                <span>{{ count($selectedRows) }} selected</span>
                <button class="btn btn-primary" wire:click="performAction">Add to Settlement</button>
                <button class="btn btn-secondary" wire:click="clearSelectedRows">Clear Selection</button>
            </div>
        </div>
    @endif
</div>
