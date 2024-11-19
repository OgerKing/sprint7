<?php

namespace App\Livewire\Views;

use App\Models\Adjudication;
use Livewire\Attributes\Url;
use Livewire\Component;

class GlobalDocumentsView extends Component
{
    #[Url]
    public $adjudication_id; // Get from URL

    public $adjudication;

    public function mount()
    {
        $this->getAdjudicationById();
    }

    public function getAdjudicationById()
    {
        $this->adjudication = Adjudication::findOrFail($this->adjudication_id);
    }

    public function render()
    {
        return view('livewire.views.global-documents-view');
    }
}
