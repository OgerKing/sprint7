<?php

namespace App\Livewire\Forms;

use App\Models\Adjudication;
use Livewire\Attributes\Validate;
use Livewire\Form;

//Form component used for the Add/Edit Adjudication sidebars
class AddOrEditAdjudicationForm extends Form
{
    public ?Adjudication $adjudication;

    #[Validate('required', 'adjudication title')]
    public $adjudication_name; //title

    #[Validate('required', 'max:10', 'prefix')]
    public $prefix;

    #[Validate('required', 'nickname')]
    public $adjudication_nickname; //nickname

    #[Validate('required', 'status')]
    public $adjudication_status_id; //status

    #[Validate('required', 'bureau')]
    public $bureau_id; //bureau

    #[Validate('required')]
    public $adjudication_boundary_map_link; //boundary_link

    // public $mapping_zones = [];
    // #[Validate('required')]
    public $mapping_zone_west;

    // #[Validate('required')]
    public $mapping_zone_central;

    // #[Validate('required')]
    public $mapping_zone_east;

    public $datum = 'NAD 27';

    public $hydrographic_survey_description = 'test description';

    public $adjudication_district_id = 1;

    public $coordinate_system = 'test coord system';

    public $created_by;

    public $updated_by;

    public function setAdjudicationForm(Adjudication $adjudication)
    {
        $userId = auth()->user()->id;

        $this->adjudication = $adjudication;

        $this->adjudication_name = $adjudication->adjudication_name;
        $this->prefix = $adjudication->prefix;
        $this->adjudication_nickname = $adjudication->adjudication_nickname;
        $this->adjudication_status_id = $adjudication->adjudication_status_id;
        $this->bureau_id = $adjudication->bureau_id;
        $this->adjudication_boundary_map_link = $adjudication->adjudication_boundary_map_link;
        $this->created_by = $userId;
        $this->updated_by = $userId;
        $this->mapping_zone_west = $adjudication->mapping_zone_west;
        $this->mapping_zone_central = $adjudication->mapping_zone_central;
        $this->mapping_zone_east = $adjudication->mapping_zone_east;
    }
}
