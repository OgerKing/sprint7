<?php

namespace App\Livewire\Views;

use Livewire\Component;

class DocumentManagementView extends Component
{
    public string $type;

    public string $document_id;

    // You can also use mount() to handle the initialization if needed
    public function mount(string $type, $document_id)
    {
        $this->type = $type;
        $this->document_id = $document_id;
    }

    public function render()
    {
        return view('livewire.views.document-management-view');
    }
}
