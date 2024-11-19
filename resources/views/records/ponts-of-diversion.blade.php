<x-app-layout>
    <div class="record-pages-container">
        <div class="row pt-4 mb-4 d-flex align-items-center">
            <livewire:records-page-selector />
            

            <div class="d-flex justify-content-end align-items-center col-lg-6 col-sm-9">
                <div class="mx-1">
                    <div class="input-group search-input-wrapper">
                        <span class="input-group-text search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control search-input form-styles" placeholder="Search Points of Diversion" />
                    </div>
                </div>
                <div class="mx-1">
                    <button type="button" class="btn btn-outline-success filter-button">
                        <div class="d-flex align-items-center">
                            <span>Filters</span>
                            {{-- <span>
                                <i class="bi bi-x"></i>
                            </span> --}}
                        </div>
                    </button>
                </div>
                <div class="records-vertical-divider mx-2"></div>
                
                <div class="mx-1">
                    <button type="button" class="btn btn-outline-primary add-record-button">
                        Add New Points of Diversion
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        
        
        <!-- Include subfiles component here -->
        Points of Diversion tables
    </div>
</x-app-layout>
