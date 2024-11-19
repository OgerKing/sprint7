<div class="user-account-settings-view">
    <div class="col-7 mx-auto my-4 py-2">
        <div class="row mt-4 mb-4">
            <div class="header col-5">Account Settings</div>
        </div>
        <form wire:submit="save" class="account-settings-container py-1">
            <div class="row d-flex mx-4 mt-4">
                <div class="col-12">
                    <div class="ua-header">User Information</div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <x-wrats-basic-text-input
                                label="Display Name"
                                id="displayNameId"
                                wire:model.live="displayName"
                                readonly
                            />
                            @error('displayName')
                                <span class="error">Display Name Required</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <x-wrats-basic-text-input
                                label="Initials"
                                id="initials-id"
                                wire:model="initials"
                                readonly
                            />
                            @error('initials')
                                <span class="error">Initials Required</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex mx-4">
                <div class="col-12">
                    <div class="ua-header mt-5">Email Notifications</div>
                    <div class="py-3">
                        @livewire(
                            'components.wrats-dropdown-select',
                            [
                                'id' => 'notificationFrequency',
                                'label' => 'Watch Subfile Changes',
                                'selectedItem' => $selectedEmailFrequency,
                                'emitTo' => 'uaOptionSelected',
                                'options' => $notificationFrequencyOptions,
                            ]
                        )
                    </div>
                </div>
            </div>
            <div class="row ua-btn-row mx-4 my-4">
                <div class="col-6">
                    <button
                        class="btn btn-grey"
                        type="button"
                        wire:click="cancelForm"
                    >
                        Cancel
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-green" type="submit">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('dropdown-item-selected', (event) => {
                console.log('Selected Item:', event.detail.value);
            });
        });
    </script>
@endpush
