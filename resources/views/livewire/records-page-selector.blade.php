<div class="col-lg-6 col-sm-3 d-flex align-items-center">
    <span class="selection-header">Record Type</span>
    <div class="dropdown-wrapper ms-2">
        <button class="btn dropdown-toggle form-styles" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $pages[$selectedRecordType] }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($recordTypes as $type => $icon)
                <li>
                    <a class="dropdown-item" href="#" wire:click.prevent="selectRecordList('{{ $type }}')">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="recordType" id="{{ $type }}" value="{{ $type }}" @checked($selectedRecordType == $type) />
                            <label class="form-check-label" for="{{ $type }}">
                                <x-dynamic-component :component="$icon" class="me-2" /> {{ $pages[$type] }}
                            </label>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>