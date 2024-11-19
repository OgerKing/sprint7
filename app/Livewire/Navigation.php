<?php

namespace App\Livewire;

use App\Models\UserSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public $currentRouteName;

    public $displayName = '';

    public function navigateToRoute($route)
    {

        // // Use Laravel's route helper to generate the URL for the specified route
        $url = route($route);

        // // Redirect the user to the generated URL
        return redirect($url);
    }

    //Set form values using auth user id to initialState array
    public function setUserName()
    {
        $userSetting = UserSetting::where('user_id', Auth::id())->first();

        if ($userSetting) {
            $this->displayName = $userSetting->display_name;
        }
    }

    public function render()
    {
        // Access the current route name passed as a parameter
        $currentRouteName = $this->currentRouteName;
        $this->setUserName();

        return view('livewire.navigation');
    }
}
