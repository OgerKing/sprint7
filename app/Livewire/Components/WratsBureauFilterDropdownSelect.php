<?php

namespace App\Livewire\Components;

use App\Models\Bureau;
use Livewire\Component;

class WratsBureauFilterDropdownSelect extends Component
{
    public $bureauOptions = [];

    public $selectedBureau;

    public $id = 'bureau-dropdown-select'; //dropdown component id

    public $label = 'Bureau'; //dropdown component label

    public $options = []; // []['value' => 'string', 'label' => 'string']

    public $selectedItem = null; //currently selected item value or default value

    public $selectedItemLabel; //currently selected item label

    public $emitTo; //the dispatch function that is listening for the selection. eg. in UserAccountSettings.php it is 'uaOptionSelected'

    public function mount($selectedItem = null)
    {
        $this->selectedBureau = $selectedItem;
        $this->loadBureaus();

        if ($selectedItem) {
            $selectedItemKeyValue = collect($options)->firstWhere('value', $selectedItem); //grab the option that matches with the selectedItem value
            $this->selectedItemLabel = $selectedItemKeyValue['label']; //use the matching option to set the label
        } else {
            $this->selectedItemLabel = 'Select an option'; //if nothing is selected, set a generic prompt
        }
    }

    public function loadBureaus()
    {
        $bureaus = Bureau::get();

        foreach ($bureaus as $bureau) {
            $bureauOptions[] = [
                'label' => $bureau->bureau_name,
                'value' => $bureau->id,
            ];
        }
        $this->options = $bureauOptions;
    }

    public function selectOption($value, $label)
    {
        $this->selectedItem = $value; //set the selectedItem value
        $this->selectedItemLabel = $label; //set the selectedItem label

    }

    public function render()
    {
        return view('livewire.components.wrats-bureau-filter-dropdown-select');
    }
}
