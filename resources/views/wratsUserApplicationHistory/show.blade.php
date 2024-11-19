{{-- resources/views/wratsUserApplicationHistory/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            {{ __('Application History') }}
        </h2>
    </x-slot>

    <div class="min-h-screen h-full py-12">
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 min-h-screen h-full"
        >
            <div class="p-4 sm:p-8 shadow sm:rounded-lg min-h-screen h-full">
                <div class="max-w-xl">
                    @livewire('views.my-history', ['groupedItems' => $groupedItems])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
