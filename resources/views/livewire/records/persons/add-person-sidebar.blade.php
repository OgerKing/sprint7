<div id="add-person-sidebar">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddPerson" aria-labelledby="offcanvasAddPersonLabel"
         x-data="{ isOpen: @entangle('isOpen') }" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasAddPersonLabel">Add New Person</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                    wire:click="resetForm" @click="isOpen = false"></button>
        </div>
        
        <hr />

        <div class="offcanvas-body">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @else
                <form wire:submit.prevent="submit">

                    <div class="mb-4">
                        <h6 class="font-weight-bold">General</h6>
                        <div class="mb-3">
                            <select class="form-control" wire:model="personType">
                                <option value="">Select Person Type</option>
                                @foreach ($personTypeOptions as $id => $typeName)
                                    <option value="{{ $id }}">{{ $typeName }}</option>
                                @endforeach
                            </select>
                            @error('personType') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <select class="form-control" wire:model="personStatus">
                                <option value="">Select Person Status</option>
                                @foreach ($personStatusOptions as $id => $statusDescription)
                                    <option value="{{ $id }}">{{ $statusDescription }}</option>
                                @endforeach
                            </select>
                            @error('personStatus') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <select class="form-control" wire:model="deceased">
                                @foreach ($deceasedOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('deceased') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <hr />

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Contact Information</h6>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email Address" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" placeholder="Phone Number" wire:model="phoneNumber">
                            @error('phoneNumber') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <hr />

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Name Information</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First Name" wire:model="firstName">
                                @error('firstName') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last Name" wire:model="lastName">
                                @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Middle Name(s)" wire:model="middleNames">
                                @error('middleNames') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Suffix" wire:model="suffix">
                                @error('suffix') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Title" wire:model="title">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Alias" wire:model="alias">
                                @error('alias') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control" wire:model="aliasType">
                                    <option value="">Select Alias Type</option>
                                    @foreach ($aliasTypeOptions as $id => $typeName)
                                        <option value="{{ $id }}">{{ $typeName }}</option>
                                    @endforeach
                                </select>
                                @error('aliasType') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Mailing Address</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Address 1" wire:model="address1">
                                @error('address1') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Address 2" wire:model="address2">
                                @error('address2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="City" wire:model="city">
                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select class="form-control" wire:model="state">
                                    <option value="">Select State</option>
                                    @foreach ($stateOptions as $id => $stateName)
                                        <option value="{{ $id }}">{{ $stateName }}</option>
                                    @endforeach
                                </select>
                                @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Postal Code" wire:model="postalCode">
                                @error('postalCode') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select class="form-control" wire:model="country">
                                    <option value="">Select Country</option>
                                    @foreach ($countryOptions as $id => $countryName)
                                        <option value="{{ $id }}">{{ $countryName }}</option>
                                    @endforeach
                                </select>
                                @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Physical Address</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Physical Address 1" wire:model="physicalAddress1">
                                @error('physicalAddress1') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Physical Address 2" wire:model="physicalAddress2">
                                @error('physicalAddress2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="City" wire:model="physicalCity">
                                @error('physicalCity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select class="form-control" wire:model="physicalState">
                                    <option value="">Select State</option>
                                    @foreach ($stateOptions as $id => $stateName)
                                        <option value="{{ $id }}">{{ $stateName }}</option>
                                    @endforeach
                                </select>
                                @error('physicalState') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Postal Code" wire:model="physicalPostalCode">
                                @error('physicalPostalCode') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select class="form-control" wire:model="physicalCountry">
                                    <option value="">Select Country</option>
                                    @foreach ($countryOptions as $id => $countryName)
                                        <option value="{{ $id }}">{{ $countryName }}</option>
                                    @endforeach
                                </select>
                                @error('physicalCountry') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <hr />
                    @error('error')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="d-flex justify-content-end gap-2 mt-auto pt-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                        <button type="submit" class="btn btn-outline-primary">Add Person</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
