<div id="adjudication-changelog-sidebar">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExampleChange" aria-labelledby="offcanvasExampleLabel"
        wire:ignore.self x-data="{ isOpen: false }" @show-offcanvas-changelog="isOpen = true"
        @close-offcanvas-changelog="closeModal(); isOpen = false">

        <div class="offcanvas-header">
            <div>
                <h6 class="offcanvas-title" id="offcanvasExampleLabel">Change log</h6>
                <p class="mb-0 small">Here you can see adjudication change activity</p>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" wire:click="closeModal"></button>
        </div>
        
        <hr class="mb-0">
        @if ($loading)
            <div class="text-center">
                <i class="bi bi-spinner" style="font-size: 2rem;" wire:loading></i>
                <p>Loading...</p>
            </div>
        @else
        <div class="offcanvas-body">
            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1 me-2">
                    <select id="dateSelect" class="form-select" wire:model="selectedDate" wire:change="updateChangelog">
                        <option value="">All dates</option>
                        @foreach ($allDates as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button class="btn btn-grey" wire:click="jumpToFirstDate">
                        Jump to first <i class="bi bi-arrow-down"></i>
                    </button>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div>
                        @if ($changelog->isEmpty() && !$loading)
                            <p>There are no changes yet...</p>
                        @else
                            <ul class="timeline-3">
                                @foreach ($changelog as $date => $changes)
                                    <li>
                                        <div class="change-wrapper">
                                            <span class="timeline-icon"><i class="bi bi-record-circle"></i></span>
                                            <span class="changelog-title">
                                                {{ \Carbon\Carbon::parse($date)->isToday() ? 'Today, ' : '' }}{{ \Carbon\Carbon::parse($date)->format('F j') }}
                                            </span>
                                        </div>
                                        <div class="change-details">
                                            @foreach ($changes as $change)
                                                <div class="change-item pt-2">
                                                    <span class="changelog-text d-block">
                                                        {{ $change['description'] }} by 
                                                        <span class="highlight">{{ $change['changed_by'] }}</span>
                                                    </span>
                                                    <span class="time-changed d-block">
                                                        {{ $change['created_at']->format('h:i A') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
