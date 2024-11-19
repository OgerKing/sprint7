<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div>
        <div>
            <div>
                <div>
                    @livewire('views.user-account-settings')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
