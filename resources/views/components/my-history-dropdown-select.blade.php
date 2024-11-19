@props([
    'selectedRecordType',
])

<div class="dropdown menu-options form-floating">
    <label for="dropdownMenuButton" class="input-label">
        Filter by Record Type
    </label>
    <button
        class="btn dropdown-toggle form-styles"
        type="button"
        id="dropdownMenuButton"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        color="transparent"
    >
        {{ $selectedRecordType }}
    </button>

    <ul
        class="dropdown-menu dropdown-menu-end"
        aria-labelledby="navbarDropdown"
    >
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('All Types')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="allTypes"
                        value="All Types"
                        @checked($selectedRecordType == 'All Types')
                    />
                    <label class="form-check-label" for="allTypes">
                        <i class="bi bi-grid"></i>
                        All Types
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Subfiles')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="subfiles"
                        value="Subfiles"
                        @checked($selectedRecordType == 'Subfiles')
                    />
                    <label class="form-check-label" for="subfiles">
                        <x-subfiles-icon />
                        Subfiles
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Parties')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="parties"
                        value="Parties"
                        @checked($selectedRecordType == 'Parties')
                    />
                    <label class="form-check-label" for="parties">
                        <x-parties-icon
                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                        />
                        Parties
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Authorized Agents')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="authorizedAgents"
                        value="Authorized Agents"
                        @checked($selectedRecordType == 'Authorized Agents')
                    />
                    <label class="form-check-label" for="authorizedAgents">
                        <x-authorized-agents-icon />
                        Authorized Agents
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Water Rights')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="waterRights"
                        value="Water Rights"
                        @checked($selectedRecordType == 'Water Rights')
                    />
                    <label class="form-check-label" for="waterRights">
                        <x-water-rights-icon />
                        Water Rights
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Sources (POD)')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="sourcesPOD"
                        value="Sources (POD)"
                        @checked($selectedRecordType == 'Sources (POD)')
                    />
                    <label class="form-check-label" for="sourcesPOD">
                        <x-sources-icon />
                        Sources (POD)
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Places (POU)')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="placesPOU"
                        value="Places (POU)"
                        @checked($selectedRecordType == 'Places (POU)')
                    />
                    <label class="form-check-label" for="placesPOU">
                        <x-places-icon />
                        Places (POU)
                    </label>
                </div>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                href="#"
                wire:click="selectRecordList('Documents')"
            >
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="recordType"
                        id="documents"
                        value="Documents"
                        @checked($selectedRecordType == 'Documents')
                    />
                    <label class="form-check-label" for="documents">
                        <x-documents-icon />
                        Documents
                    </label>
                </div>
            </a>
        </li>
    </ul>
</div>
