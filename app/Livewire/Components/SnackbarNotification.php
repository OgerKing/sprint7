<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SnackbarNotification extends Component
{
    public $message; //the message you want displayed

    public $type; // error or success

    public $messageTitle; //set by type of message

    public $show = false;

    protected $listeners = ['flashMessage'];

    public function mount()
    {
        $this->message = session('status');
        $this->type = session('status_type', 'success'); // default type

    }

    public function flashMessage($message, $type)
    {
        $this->message = $message;
        $this->type = $type;

        if ($this->type == 'success') {
            $this->messageTitle = 'Success';
        } elseif ($this->type == 'error') {
            $this->messageTitle = 'Error';
        } elseif ($this->type == 'warning') {
            $this->messageTitle = 'Warning';
        } elseif ($this->type == 'info') {
            $this->messageTitle = 'Information';
        }

        $this->dispatch('flash-message'); //this triggers the @flash-message event to show message in snackbar-notification.blade.php
    }

    public function render()
    {
        return view('livewire.components.snackbar-notification');
    }
}
