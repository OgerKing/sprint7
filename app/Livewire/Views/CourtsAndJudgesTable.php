<?php

namespace App\Livewire\Views;

use App\Livewire\Forms\AdjudicationSectionForm;
use App\Models\Adjudication;
use Livewire\Attributes\Url;
use Livewire\Component;

class CourtsAndJudgesTable extends Component
{
    public AdjudicationSectionForm $form;

    #[Url]
    public $adjudication_id;

    public $adjudication;

    public $adjudicationName;

    public $caj_permissions;

    public function mount()
    {
        $this->adjudication = Adjudication::where('id', $this->adjudication_id)->with('adjudication_status', 'bureau')->first();

        $this->adjudicationName = $this->adjudication->adjudication_name;

        $this->courtsAndJudgesPermissions();
    }

    public function courtsAndJudgesPermissions()
    {
        // Check if the adjudication status is 'Final Decree'
        if ($this->adjudication->adjudication_status->adjudication_status_description === 'Final Decree') {
            $this->caj_permissions = 'sys-admin only';
        }
        // Check if the user has the role 'WRATS_LawClerk'
        elseif (auth()->user()->hasRole('WRATS_LawClerk')) {
            // Check if the user's bureaus contain the adjudication's bureau_id
            $userBureauIds = auth()->user()->bureaus->pluck('id')->toArray(); // Get user's bureau IDs as an array

            if (in_array($this->adjudication->bureau_id, $userBureauIds)) {

                $this->caj_permissions = 'bureau-law-clerk-and-up';
            } else {
                // If the user's bureaus do not match the adjudication's bureau_id
                $this->caj_permissions = 'sys-admin and lap admin only';
            }
        }
        // Default permission for other roles
        else {
            $this->caj_permissions = 'sys-admin and lap admin only';
        }
    }

    public function render()
    {
        return view('livewire.views.courts-and-judges-table');
    }
}
