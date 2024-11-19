<?php

namespace App\Livewire\Components;

use Livewire\Component;

class WratsDropdownSelect extends Component
{
    public $id; //dropdown component id

    public $label; //dropdown component label

    public $options = []; // []['value' => 'string', 'label' => 'string']

    public $selectedItem; //currently selected item value or default value

    public $selectedItemLabel; //currently selected item label

    public $emitTo; //the dispatch function that is listening for the selection. eg. in UserAccountSettings.php it is 'uaOptionSelected'

    public $disabled;

    protected $listeners = ['selectOption', 'clearDropdown'];

    public function mount($id, $label, $options, $selectedItem, $emitTo, $disabled = false)
    {
        $this->id = $id;
        $this->label = $label;
        $this->options = $options;
        $this->selectedItem = $selectedItem;
        $this->emitTo = $emitTo;
        $this->disabled = $disabled;

        if (! is_null($selectedItem)) {
            $this->setDropdownLabelValue();
        } else {
            $this->selectedItemLabel = 'Select an option';
        }

    }

    public function selectOption($value, $label)
    {
        $this->selectedItem = $value; //set the selectedItem value
        $this->selectedItemLabel = $label; //set the selectedItem label
        $this->dispatch($this->emitTo, $value); //emitTo parameter should be the name of the function the parent component is looking for. eg. in UserAccountSettings.php it is 'uaOptionSelected'
    }

    public function setDropdownLabelValue()
    {
        if ($this->selectedItem !== null) {
            $selectedItemKeyValue = collect($this->options)->firstWhere('value', $this->selectedItem); //grab the option that matches with the selectedItem value
            $this->selectedItemLabel = $selectedItemKeyValue['label']; //use the matching option to set the label
        } else {

            $this->selectedItemLabel = 'Select an option'; //if nothing is selected, set a generic prompt
        }

    }

    public function clearDropdown()
    {
        $this->selectedItem = null;
        $this->selectedItemLabel = 'Select an option';
        $this->setDropdownLabelValue();

    }

    public function render()
    {
        return view('livewire.components.wrats-dropdown-select');
    }
}
