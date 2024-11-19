<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FirstLoginModal extends Component
{
    public $showModal;

    public function __construct()
    {
        $this->showModal = Auth::check() && is_null(Auth::user()->first_login);

        if ($this->showModal) {
            $user = Auth::user();
            $user->first_login = now();
            $user->save();
        }
    }

    public function render()
    {
        return view('components.first-login-modal');
    }
}
