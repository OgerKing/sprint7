<div class="my-history-view">
    <div class="row mt-4 mx-4 mb-4">
        <div class="header col-lg-5 col-sm-3">My History</div>

        <div class="d-flex justify-content-between col-lg-7 col-sm-9">
            <div class="row input-row">
                <div class="col-lg-4 col-sm-4">
                    <div class="input-group mb-3 search-input-wrapper">
                        <span class="input-group-text search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control search-input form-styles"
                            wire:model.lazy="search"
                            placeholder="Search"
                        />
                    </div>
                </div>
                <div class="input-wrapper col-lg-4 col-sm-4 date-range-div">
                    <x-my-history-daterange-picker />
                </div>
                <div class="input-wrapper col-lg-4 col-sm-4">
                    <x-my-history-dropdown-select
                        selectedRecordType="{{$selectedRecordType}}"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="history-list d-flex justify-content-center">
            <div class="col-lg-6 col-sm-12">
                @if (empty($groupedItems))
                    <div class="alert alert-warning text-center">
                        No matches for selected filters
                    </div>
                @else
                    @foreach ($groupedItems as $date => $items)
                        <div class="date-hr" wire:key="date-{{ $date }}">
                            <hr />
                            <span class="badge rounded-pill">
                                {{ $this->getLabelForDate($date) }}
                            </span>
                        </div>

                        @foreach ($items as $item)
                            <div class="card" wire:key="item-{{ $item->id }}">
                                <div class="card-body">
                                    <div
                                        class="d-flex align-items-center w-100"
                                    >
                                        <div class="me-3">
                                            @if ($item->record_type === 'Subfiles')
                                                <x-history-subfiles-icon />
                                            @elseif ($item->record_type === 'Parties')
                                                <x-history-parties-icon />
                                            @elseif ($item->record_type === 'Authorized Agents')
                                                <x-history-authorized-agents-icon />
                                            @elseif ($item->record_type === 'Water Rights')
                                                <x-history-water-rights-icon />
                                            @elseif ($item->record_type === 'Sources (POD)')
                                                <x-history-sources-icon />
                                            @elseif ($item->record_type === 'Places (POU)')
                                                <x-history-places-icon />
                                            @elseif ($item->record_type === 'Documents')
                                                <x-history-documents-icon />
                                            @endif
                                        </div>
                                        <div class="history-card-details">
                                            <div>
                                                <div
                                                    class="d-flex align-items-center justify-content-between"
                                                >
                                                    <div
                                                        class="history-item-title"
                                                    >
                                                        {{ $item->label }}
                                                    </div>
                                                    <div
                                                        class="history-item-time light-grey"
                                                    >
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('g:iA') }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="history-item-description light-grey"
                                                >
                                                    {{ $item->path }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
