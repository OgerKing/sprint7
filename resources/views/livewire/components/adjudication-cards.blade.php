<div>
    <div class="adjudication-cards-component" x-data>
        <div class="card-container">
            <div class="adjudication-card">
                <div class="card-section">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <div class="card-title">
                                {{ $adjudication->adjudication_name }}
                            </div>
                            <div class="nickname">
                                {{ $adjudication->adjudication_nickname }}
                            </div>
                        </div>
                        @can('see adudication elipse')
                            <div class="adjudications-options-dropdown">
                                <button
                                    type="button"
                                    id="adjudicationsDropdownButton"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    color="transparent"
                                    class="btn ac-dropdown form-styles"
                                >
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="adjudicationsDropdown"
                                >
                                    @can($edit_adjudication_permissions)
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click="emitId({{ $adjudication->id }})"
                                                onclick="event.preventDefault(); event.stopPropagation();"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasExample"
                                                aria-controls="offcanvasExample"
                                            >
                                                <i class="bi bi-pencil"></i>
                                                <span class="li-label">
                                                    Edit
                                                </span>
                                            </a>
                                        </li>

                                        <li><hr class="dropdown-divider" /></li>
                                    @endcan

                                    <li>
                                        <a
                                            class="dropdown-item"
                                            role="button"
                                            wire:navigate
                                            href="/sections?adjudication_id={{ $adjudication->id }}"
                                        >
                                            <i class="bi bi-pie-chart"></i>
                                            <span class="li-label">
                                                Adjudication Sections
                                            </span>
                                        </a>
                                    </li>

                                    @can('read court')
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                role="button"
                                                wire:navigate
                                                href="/courts-and-judges?adjudication_id={{ $adjudication->id }}"
                                            >
                                                <!-- TODO: custom icon -->
                                                <i class="bi bi-house-door"></i>
                                                <span class="li-label">
                                                    Courts & Judges
                                                </span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can($split_and_combine_permissions)
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                role="button"
                                                wire:navigate
                                                href="/split?adjudication_id={{ $adjudication->id }}"
                                            >
                                                <i
                                                    class="bi bi-arrows-expand-vertical"
                                                ></i>
                                                <span class="li-label">
                                                    Split
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                role="button"
                                                wire:navigate
                                                href="/combine?adjudication_id={{ $adjudication->id }}"
                                            >
                                                <!-- TODO: custom icon -->
                                                <i class="bi bi-shuffle"></i>
                                                <span class="li-label">
                                                    Combine
                                                </span>
                                            </a>
                                        </li>
                                    @endcan

                                    <li><hr class="dropdown-divider" /></li>
                                    @can('read global documents')
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                role="button"
                                                wire:navigate
                                                href="/global-document?adjudication_id={{ $adjudication->id }}"
                                            >
                                                <i class="bi bi-globe2"></i>
                                                <span class="li-label">
                                                    Global Documents
                                                </span>
                                            </a>
                                        </li>
                                    @endcan

                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            wire:click="emitChangeLog({{ $adjudication->id }})"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasExampleChange"
                                            aria-controls="offcanvasExampleChange"
                                        >
                                            <i class="bi bi-clock"></i>
                                            <span class="li-label">
                                                Change Log
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    </div>
                    <span
                        class="badge default rounded-pill mb-2 {{ str_replace(' ', '-', $adjudicationStatus->adjudication_status_description) }}"
                    >
                        <i class="bi bi-circle fs-14"></i>
                        {{ $adjudicationStatus->adjudication_status_description }}
                    </span>

                    <div class="coord-system">
                        Coordinate System:
                        {{ $adjudication->coordinate_system }}
                    </div>
                    <div class="coord-direction mb-2">
                        <span>
                            {{
                                collect([
                                    $adjudication->mapping_zone_west ? 'West' : null,
                                    $adjudication->mapping_zone_central ? 'Central' : null,
                                    $adjudication->mapping_zone_east ? 'East' : null,
                                ])
                                    ->filter()
                                    ->implode(' - ')
                            }}
                        </span>

                        {{ $adjudication->datum }}
                    </div>
                    <div class="boundary-link">
                        <a
                            href="{{ Str::startsWith($adjudication->adjudication_boundary_map_link, ['http://', 'https://']) ? $adjudication->adjudication_boundary_map_link : 'http://' . $adjudication->adjudication_boundary_map_link }}"
                            target="_blank"
                        >
                            ADJ Boundary
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
                <hr />
                <div class="card-section">
                    <div class="d-flex align-items-center">
                        <div class="basin-icon">
                            <x-basin-icon />
                        </div>
                        <div class="sections-managed">
                            Has
                            <span class="section-number highlight">
                                {{ $numberOfSections }} sections
                            </span>
                            managed by the
                            <span class="management">
                                {{ $bureau->bureau_name }}
                            </span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="card-section">
                    <div class="subfile-count">
                        <span class="subfile-number highlight">88</span>
                        out of
                        <span class="subfile-out-of highlight">100</span>
                        subfiles are finalized and
                        <span class="open-subfiles highlight">12</span>
                        are still open
                    </div>
                    <div class="mt-3">
                        <div class="progress">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 88%"
                                aria-valuenow="88"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                88 finalized
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="subfile-type-badge">
                            <span class="subfile-badge-number">125</span>
                            Rights
                        </div>
                        <div class="subfile-type-badge">
                            <span class="subfile-badge-number">150</span>
                            POD
                        </div>
                        <div class="subfile-type-badge">
                            <span class="subfile-badge-number">550</span>
                            POU
                        </div>
                        <div class="subfile-type-badge">
                            <span class="subfile-badge-number">2000</span>
                            Persons
                        </div>
                    </div>

                    <div class="watching-subfiles-component my-2">
                        <span class="badge badge-pill">
                            <i class="bi bi-eye"></i>
                            Watching 22 subfiles
                        </span>
                    </div>
                </div>
                <hr />
                <div class="card-section">
                    <div class="court-cases">
                        <div class="cc-title mb-2">Court Cases</div>
                        <div class="courts">
                            @if (! empty($courtCaseList))
                                @foreach ($courtCaseList as $courtCase)
                                    <div>
                                        <x-court-icon />
                                        {{ $courtCase['court_name'] }}:
                                        {{ $courtCase['case_number'] }}
                                    </div>
                                @endforeach
                            @else
                                    No Courts Assigned
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
