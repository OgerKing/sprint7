<?php

namespace App\Livewire\Views;

use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAccountSettings extends Component
{
    public $initialState = []; //initial values for form, canceled forms revert to these values

    public $selectedEmailFrequency; //newly selected email frequency from dropdown

    public $displayName = '';

    public $initials = '';

    public $notificationFrequencyOptions = [
        ['value' => 'None', 'label' => 'None'],
        ['value' => 'Daily', 'label' => 'Daily'],
        ['value' => 'Weekly', 'label' => 'Weekly'],
    ];

    protected $listeners = ['uaOptionSelected'];

    //required fields to submit form
    protected $rules = [
        'displayName' => 'required',
        'initials' => 'required',
        'selectedEmailFrequency' => 'required',
    ];

    //Set form values using auth user id to initialState array
    public function setInitialValues()
    {
        $userSetting = UserSetting::where('user_id', Auth::id())->first();

        if ($userSetting) {
            $this->initialState = [
                'displayName' => $userSetting->display_name,
                'initials' => $userSetting->initials,
                'selectedEmailFrequency' => $userSetting->watch_subfile_changes_frequency,
            ];

            $this->resetForm();
        }
    }

    //use initialState array to set variables used by components in the blade view. n
    public function resetForm()
    {
        $this->displayName = $this->initialState['displayName'];
        $this->initials = $this->initialState['initials'];
        $this->selectedEmailFrequency = $this->initialState['selectedEmailFrequency'];
    }

    public function mount()
    {
        $this->setInitialValues();
    }

    //reset form to initialState if cancel button clicked
    public function cancelForm()
    {
        $this->resetForm();
        session()->flash('status', 'Settings were discarded');
        session()->flash('status_type', 'info'); // Flash info type
        $this->dispatch('flashMessage', session('status'), session('status_type'));
    }

    //dropdown select
    public function uaOptionSelected($value)
    {
        $this->selectedEmailFrequency = $value;
    }

    //save form
    public function save()
    {
        $this->validate(); //validate $rules

        $userId = Auth::id();
        $now = Carbon::now()->format('Y-m-d H:i:s'); // get current date and time

        // get user setting by id
        $userSetting = UserSetting::where('user_id', $userId)->first();

        // create attributes array to send to updateOrCreate row
        $attributes = [
            'user_id' => $userId,
            'display_name' => $this->displayName,
            'initials' => $this->initials,
            'watch_subfile_changes_frequency' => $this->selectedEmailFrequency,
            'updated_by' => $userId,
            'updated_at' => $now,
        ];

        // If row does not exist, add created_by and created_at fields
        if (! $userSetting) {
            $attributes['created_by'] = $this->displayName;
            $attributes['created_at'] = $now;
        }

        // use updateOrCreate to update or create the record
        UserSetting::updateOrCreate(
            ['user_id' => $userId],
            $attributes
        );

        session()->flash('status', 'User settings successfully updated.');
        session()->flash('status_type', 'success'); // Flash success type
        $this->dispatch('flashMessage', session('status'), session('status_type'));

        $this->setInitialValues(); // Refresh initial values after saving
    }

    public function render()
    {
        return view('livewire.views.user-account-settings');
    }
}
