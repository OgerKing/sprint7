<x-app-layout>
    <div class="record-pages-container">
        <div class="row pt-4 d-flex align-items-center">
            <livewire:records.documents-records-filter />
        </div>
        <!-- Include subfiles component here -->
        <livewire:records.documents-records />

        <!-- Include subfiles component here -->

        <!-- TODO: putting these here for demo purposes, will  not be the correct component. if this conflicts with your branch, choose your branch! -MA-->
        <div>@livewire('views.records-list')</div>
    </div>
</x-app-layout>
