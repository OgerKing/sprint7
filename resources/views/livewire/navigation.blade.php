<div>
    <!-- Full screen nav -->
    <div class="d-none d-lg-block">
        <div>
            <nav
                class="navbar navbar-expand-lg bg-primary"
                id="wrats-navigation"
            >
                <div
                    class="container-fluid d-flex justify-content-between align-items-center"
                >
                    <div class="shrink-0 items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo
                                class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                            />
                        </a>
                    </div>
                    <div class="d-flex mx-3">
                        <div class="btn-group mx-5">
                            <button
                                wire:click="navigateToRoute('records')"
                                class="btn btn-secondary {{ $currentRouteName === 'records' || str_starts_with($currentRouteName, 'records.') ? 'active' : '' }}"
                            >
                                Records
                            </button>

                            <button
                                wire:click="navigateToRoute('adjudications')"
                                class="btn btn-secondary {{ $currentRouteName === 'adjudications' ? 'active' : '' }}"
                            >
                                Adjudications
                            </button>
                            <button
                                wire:click="navigateToRoute('reports')"
                                class="btn btn-secondary {{ $currentRouteName === 'reports' ? 'active' : '' }}"
                            >
                                Reports
                            </button>
                        </div>
                        <div class="dropdown menu-options">
                            <div
                                class="account-avatar text-white"
                                role="button"
                                id="navbarDropdown"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <div class="flex align-items-center">
                                    <x-user-avatar />
                                    {{ $displayName }}
                                </div>
                            </div>
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdown"
                            >
                                <li>
                                    <a
                                        class="dropdown-item"
                                        wire:click="navigateToRoute('account-settings')"
                                    >
                                        <i class="bi bi-gear"></i>
                                        Account Settings
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        wire:click="navigateToRoute('my-history')"
                                    >
                                        <i class="bi bi-clock"></i>
                                        My History
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ url('knowledge-base/doku.php?id=start') }}"
                                        target="_blank"
                                    >
                                        <i class="bi bi-book"></i>
                                        Knowledge Base
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        wire:click="navigateToRoute('support')"
                                    >
                                        <i class="bi bi-question-circle"></i>
                                        Support
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}"
                                    >
                                        @csrf
                                        <a
                                            class="dropdown-item"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                        >
                                            <i
                                                class="bi bi-box-arrow-right"
                                            ></i>
                                            Log Out
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div class="d-lg-none">
        <nav class="navbar navbar-expand-lg bg-primary pt-0">
            <div
                class="container-fluid d-flex justify-content-between align-items-center"
            >
                <div class="shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ URL::asset('/images/logo.svg') }}" />
                    </a>
                </div>
                <!-- Hamburger menu -->
                <button
                    class="navbar-toggler mb-2 mr-1"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i
                        class="bi bi-list"
                        style="color: white; font-size: 30px"
                    ></i>
                </button>
                <div
                    class="collapse navbar-collapse justify-content-end"
                    id="navbarNav"
                >
                    <ul
                        class="dropdown-menu dropdown-menu-end navbar-nav w-100"
                        aria-labelledby="navbarDropdown"
                    >
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('records')"
                            >
                                Records
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('adjudications')"
                            >
                                Adjudications
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('reports')"
                            >
                                Reports
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('account-settings')"
                            >
                                <i class="bi bi-gear"></i>
                                Account Settings
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('my-history')"
                            >
                                <i class="bi bi-clock"></i>
                                My History
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('knowledge-base')"
                            >
                                <i class="bi bi-book"></i>
                                Knowledgebase
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                wire:click="navigateToRoute('support')"
                            >
                                <i class="bi bi-question-circle"></i>
                                Support
                            </a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a
                                    class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
