<?php

namespace App\Livewire\Views;

use App\Livewire\Forms\AddOrEditAdjudicationForm;
use App\Models\Adjudication;
use App\Models\AdjudicationStatus;
use App\Models\Bureau;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class CombineView extends Component
{
    public AddOrEditAdjudicationForm $form;

    #[Url]
    public $adjudication_id; // Get from URL

    public $adjudication;

    public $availableAdjudications;

    public ?int $selectedAdjudicationId = null;

    public $bureauOptions;

    public $statusOptions;

    public int $step = 1;

    public bool $understood = false;

    public function mount()
    {
        $this->adjudication = Adjudication::findOrFail($this->adjudication_id);
        //load dropdown options
        $this->loadBureaus();
        $this->loadStatuses();
        $this->getAllAdjudications();
    }

    public function getAllAdjudications()
    {
        //get all adjudications EXCEPT the selected one.
        $this->availableAdjudications = Adjudication::where('id', '!=', $this->adjudication_id)->get();
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function nextStepValidate()
    {
        $this->validate();
        $this->step++;
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
        $this->bureauOptions = $bureauOptions;
    }

    public function loadStatuses()
    {
        $statuses = AdjudicationStatus::get();

        foreach ($statuses as $status) {
            $statusOptions[] = [
                'label' => $status->adjudication_status_description,
                'value' => $status->id,
            ];
        }
        $this->statusOptions = $statusOptions;
    }

    public function save()
    {
        DB::transaction($this->combineAdjudications(...));

        session()->flash('success', 'Adjudications successfully combined.');

        $this->redirectRoute('adjudications');
    }

    public function combineAdjudications()
    {
        // Create new adjudication
        $adjudication = Adjudication::create([
            'adjudication_name' => $this->form->adjudication_name, // title
            'prefix' => $this->form->prefix, // prefix
            'adjudication_nickname' => $this->form->adjudication_nickname, // nickname
            'adjudication_status_id' => $this->form->adjudication_status_id, // status
            'bureau_id' => $this->form->bureau_id, // bureau
            'adjudication_boundary_map_link' => $this->form->adjudication_boundary_map_link, // link

            'adjudication_district_id' => $this->adjudication->adjudication_district_id,

            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $this->adjudication->adjudication_sections()->withTrashed()->update(['adjudication_id' => $adjudication->id]);
        $this->selectedAdjudication->adjudication_sections()->withTrashed()->update(['adjudication_id' => $adjudication->id]);

        $this->adjudication->adjudication_document_programs()->update(['adjudication_id' => $adjudication->id]);
        $this->selectedAdjudication->adjudication_document_programs()->update(['adjudication_id' => $adjudication->id]);

        $this->adjudication->global_documents()->withTrashed()->update(['adjudication_id' => $adjudication->id]);
        $this->selectedAdjudication->global_documents()->withTrashed()->update(['adjudication_id' => $adjudication->id]);

        $this->adjudication->delete();
        $this->selectedAdjudication->delete();
    }

    public function render()
    {
        return view('livewire.views.combine-view');
    }

    #[Computed]
    public function selectedAdjudication()
    {
        return Adjudication::find($this->selectedAdjudicationId);
    }
}
