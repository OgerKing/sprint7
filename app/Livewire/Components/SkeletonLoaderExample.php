<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SkeletonLoaderExample extends Component
{
    public $showPlaceholder = false;

    public function loading()
    {
        $this->showPlaceholder = true;
        $this->dispatch('reset-placeholder', ['delay' => 3000]);
    }

    public function hidePlaceholder()
    {
        $this->showPlaceholder = false;
    }

    public function render()
    {
        return view('livewire.components.skeleton-loader-example');
    }
}
