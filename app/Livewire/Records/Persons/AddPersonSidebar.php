<?php

namespace App\Livewire\Records\Persons;

use App\Models\Country;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\PersonAliasType;
use App\Models\PersonEmail;
use App\Models\PersonStatus;
use App\Models\PersonTelephone;
use App\Models\PersonTypeSubtype;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * Livewire component for adding/editing person records via sidebar
 *
 * @property bool $isOpen Controls sidebar visibility
 * @property int|null $personType Selected person type ID
 * @property int|null $personStatus Selected person status ID
 * @property bool|null $deceased Person deceased status
 * @property bool|null $isCorporateContact Corporate contact status
 * @property string|null $caretakerName Person's caretaker name
 * @property string|null $handlingInstructions Special handling instructions
 * @property string|null $lastName Person's last name
 * @property string|null $firstName Person's first name
 * @property string|null $middleNames Person's middle names
 * @property string|null $suffix Name suffix
 * @property string|null $title Person's title
 * @property string|null $alias Alias name
 * @property int|null $aliasType Selected alias type ID
 * @property array $personTypeOptions Available person types
 * @property array $personStatusOptions Available person statuses
 * @property array $deceasedOptions Deceased status options
 * @property array $aliasTypeOptions Available alias types
 * @property array $countryOptions Available countries
 * @property array $stateOptions Available states
 */
class AddPersonSidebar extends Component
{
    public $isOpen = false;

    public $personType;

    public $personStatus;

    public $deceased;

    public $isCorporateContact;

    public $caretakerName;

    public $handlingInstructions;

    public $lastName;

    public $firstName;

    public $middleNames;

    public $suffix;

    public $title;

    public $alias;

    public $aliasType;

    public $address1;

    public $address2;

    public $city;

    public $zone;

    public $postalCode;

    public $country;

    public $state;

    public $physicalAddress1;

    public $physicalAddress2;

    public $physicalCity;

    public $physicalState;

    public $physicalZone;

    public $physicalPostalCode;

    public $physicalCountry;

    public $email;

    public $phoneNumber;

    public array $personTypeOptions = [];

    public array $personStatusOptions = [];

    public array $deceasedOptions = [0 => 'Alive', 1 => 'Deceased'];

    public array $aliasTypeOptions = [];

    public array $countryOptions = [];

    public array $stateOptions = [];

    protected $rules = [
        'personType' => 'required',
        'personStatus' => 'required',
        'deceased' => 'in:0,1',
        'lastName' => 'required',
        'firstName' => 'required',
        'suffix' => 'max:15',
        'aliasType' => 'required',
        'address1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'physicalAddress1' => 'required',
        'physicalCity' => 'required',
        'physicalState' => 'required',
        'physicalCountry' => 'required',
        'email' => 'required|email',
        'phoneNumber' => 'required',
        'postalCode' => ['required', 'regex:/^[0-9-]+$/'],
        'physicalPostalCode' => ['required', 'regex:/^[0-9-]+$/'],
    ];

    protected $messages = [
        'postalCode.regex' => 'Postal code may only contain numbers and hyphens',
        'physicalPostalCode.regex' => 'Physical postal code may only contain numbers and hyphens',
    ];

    /**
     * Initialize the component
     *
     * @param  int|null  $personId  Optional person ID for editing existing record
     * @return void
     */
    public function mount($personId = null)
    {
        $this->loadDropdownOptions();

        if ($personId) {
            $this->loadPersonData($personId);
        }
    }

    /**
     * Load all dropdown options from database
     *
     * @return void
     */
    private function loadDropdownOptions()
    {
        $this->personTypeOptions = PersonTypeSubtype::pluck('person_type_subtype_name', 'id')->toArray();
        $this->personStatusOptions = PersonStatus::pluck('person_status_description', 'id')->toArray();
        $this->aliasTypeOptions = PersonAliasType::pluck('person_alias_type_name', 'id')->toArray();
        $this->countryOptions = Country::pluck('country_name', 'id')->toArray();
        $this->stateOptions = State::pluck('state_name', 'id')->toArray();
    }

    /**
     * Load existing person data for editing
     *
     * @param  int  $personId  Person ID to load
     * @return void
     */
    private function loadPersonData($personId)
    {
        $person = Person::find($personId);

        if ($person) {
            $this->personType = $person->person_type_subtype_id;
            $this->personStatus = $person->person_status_id;
            $this->deceased = $person->deceased;
            $this->lastName = $person->last_name;
            $this->firstName = $person->first_name;
            $this->aliasType = $person->alias_type_id;

            // Load mailing address
            $this->address1 = $person->address->mailing_address_address_1;
            $this->address2 = $person->address->mailing_address_address_2;
            $this->city = $person->address->mailing_address_city;
            $this->state = $person->address->mailing_address_state;
            $this->postalCode = $person->address->mailing_address_postal_code;
            $this->country = $person->address->mailing_address_country;

            // Load physical address
            $this->physicalAddress1 = $person->address->physical_address_address_1;
            $this->physicalAddress2 = $person->address->physical_address_address_2;
            $this->physicalCity = $person->address->physical_address_city;
            $this->physicalState = $person->address->physical_address_state;
            $this->physicalPostalCode = $person->address->physical_address_postal_code;
            $this->physicalCountry = $person->address->physical_address_country;

            $this->email = $person->person_email->primary_contact_email ?? '';
            $this->phoneNumber = $person->person_telephone->primary_person_telephone_anumber ?? '';
        }
    }

    /**
     * Handle form submission
     *
     * @return void
     *
     * @throws ValidationException When validation or database operations fail
     */
    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $email = $this->createOrUpdateEmail();
            $telephone = $this->createOrUpdateTelephone();
            $address = $this->createOrUpdateAddress($email->id, $telephone->id);
            $person = $this->createOrUpdatePerson($address->id, $email->id, $telephone->id);

            if ($this->aliasType) {
                $this->createAlias($person);
            }

            DB::commit();

            session()->flash('success', 'Person added successfully!');
            $this->resetForm();
            $this->isOpen = false;

            // Emit an event to refresh the PersonsRecords component
            $this->dispatch('close-offcanvas');
            $this->dispatch('person-added')->to('records.persons-records');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['error' => 'Failed to add person. Please try again.']);
        }
    }

    /**
     * Create or update person email record
     */
    private function createOrUpdateEmail(): PersonEmail
    {
        return PersonEmail::create([
            'primary_contact_email' => $this->email,
            'secondary_contact_email' => $this->email,
            'secondary_contact_email_verified' => 0,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
        ]);
    }

    /**
     * Create or update person telephone record
     */
    private function createOrUpdateTelephone(): PersonTelephone
    {
        return PersonTelephone::create([
            'primary_person_telephone_anumber' => $this->phoneNumber,
            'secondary_person_telephone_number' => $this->phoneNumber,
            'secondary_person_telephone_number_verified' => 0,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
        ]);
    }

    /**
     * Create or update person address record
     *
     * @param  int  $emailId  Associated email record ID
     * @param  int  $telephoneId  Associated telephone record ID
     */
    private function createOrUpdateAddress($emailId, $telephoneId): PersonAddress
    {
        return PersonAddress::create([
            'mailing_address_address_1' => $this->address1,
            'mailing_address_address_2' => $this->address2,
            'mailing_address_city' => $this->city,
            'mailing_address_state' => $this->getStateAbbreviation($this->state),
            'mailing_address_postal_code' => $this->postalCode,
            'mailing_address_country' => $this->country,
            'physical_address_address_1' => $this->physicalAddress1,
            'physical_address_address_2' => $this->physicalAddress2,
            'physical_address_city' => $this->physicalCity,
            'physical_address_state' => $this->getStateAbbreviation($this->physicalState),
            'physical_address_postal_code' => $this->physicalPostalCode,
            'physical_address_country' => $this->physicalCountry,
            'person_email_id' => $emailId,
            'person_telephone_id' => $telephoneId,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
        ]);
    }

    /**
     * Create or update person record
     *
     * @param  int  $addressId  Associated address record ID
     * @param  int  $emailId  Associated email record ID
     * @param  int  $telephoneId  Associated telephone record ID
     */
    private function createOrUpdatePerson($addressId, $emailId, $telephoneId): Person
    {
        return Person::updateOrCreate(
            ['id' => $this->personId ?? null],
            [
                'person_type_id' => $this->personType,
                'person_status_id' => $this->personStatus,
                'is_deceased' => $this->deceased,
                'last_name' => $this->lastName,
                'first_name' => $this->firstName,
                'suffix' => $this->suffix,
                'person_address_id' => $addressId,
                'person_email_id' => $emailId,
                // 'person_telephone_id' => $telephoneId,
                'created_by' => auth()->user()->name,
                'updated_by' => auth()->user()->name,
            ]
        );
    }

    /**
     * Create person alias record
     *
     * @param  Person  $person  Associated person record
     */
    private function createAlias($person): void
    {
        $person->person_aliases()->create([
            'person_alias_type_id' => $this->aliasType,
            'entity_name' => 'TBD',
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'middle_name' => $this->middleNames ?? null,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
        ]);
    }

    /**
     * Get state abbreviation from state ID
     *
     * @param  int  $stateId  State ID
     * @return string State abbreviation
     */
    private function getStateAbbreviation($stateId): string
    {
        return State::where('id', $stateId)->value('state_abbreviation');
    }

    /**
     * Reset all form fields to default values
     *
     * @return void
     */
    public function resetForm()
    {
        $this->reset([
            'personType', 'personStatus', 'deceased', 'isCorporateContact',
            'caretakerName', 'handlingInstructions', 'lastName', 'firstName',
            'middleNames', 'suffix', 'title', 'alias', 'aliasType', 'address1',
            'address2', 'city', 'state', 'zone', 'postalCode', 'country', 'email',
            'phoneNumber', 'physicalAddress1', 'physicalAddress2', 'physicalCity',
            'physicalState', 'physicalZone', 'physicalPostalCode', 'physicalCountry',
        ]);
    }

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.records.persons.add-person-sidebar');
    }
}
