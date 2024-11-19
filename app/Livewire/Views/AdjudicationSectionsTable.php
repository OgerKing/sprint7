<?php

namespace App\Livewire\Views;

use App\Livewire\Forms\AdjudicationSectionForm;
use App\Models\Adjudication;
use Livewire\Attributes\Url;
use Livewire\Component;

class AdjudicationSectionsTable extends Component
{
    public AdjudicationSectionForm $form;

    #[Url]
    public $adjudication_id; //get adjudication_id from url

    public $adjudicationName;

    public function mount()
    {
        $adjudication = Adjudication::find($this->adjudication_id);
        $this->adjudicationName = $adjudication->adjudication_name;
    }

    public function render()
    {
        return view('livewire.views.adjudication-sections-table');
    }
}
