<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SubfilePerson
 *
 * @property int $id
 * @property int $subfile_id
 * @property int $person_id
 * @property Carbon|null $person_open_date
 * @property Carbon|null $person_close_date
 * @property int $person_status
 * @property int $person_type
 * @property string|null $category
 * @property int|null $cert_mail
 * @property string|null $cid_no
 * @property int|null $person_email
 * @property int|null $person_telephone
 * @property string|null $mailing_address_address1
 * @property string|null $mailing_address_address2
 * @property string|null $mailing_address_city
 * @property string|null $mailing_address_county
 * @property int|null $mailing_address_postal_code
 * @property string|null $mailing_address_state
 * @property string|null $authorized_agent_last_name
 * @property string|null $authorized_agent_first_name
 * @property string|null $authorized_agent_middle_initial
 * @property string|null $authorized_agent_title
 * @property string|null $authorized_agent_firm
 * @property int|null $is_authorized_agent
 * @property int|null $is_permittee
 * @property int|null $is_defendant
 * @property int|null $defendant_type_id
 * @property string $owner_set
 * @property int $person_interest_type_id
 * @property int $person_legal_interest_type_id
 * @property int $person_address_id
 * @property int $authorized_agent_person_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property DefendantType|null $defendant_type
 * @property PersonAddress $person_address
 * @property Person $person
 * @property PersonInterestType $person_interest_type
 * @property PersonLegalInterestType $person_legal_interest_type
 * @property Subfile $subfile
 */
class SubfilePerson extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'subfile_persons';

    protected $casts = [
        'subfile_id' => 'int',
        'person_id' => 'int',
        'person_open_date' => 'datetime',
        'person_close_date' => 'datetime',
        'person_status' => 'int',
        'person_type' => 'int',
        'cert_mail' => 'int',
        'person_email' => 'int',
        'person_telephone' => 'int',
        'mailing_address_postal_code' => 'int',
        'is_authorized_agent' => 'int',
        'is_permittee' => 'int',
        'is_defendant' => 'int',
        'defendant_type_id' => 'int',
        'person_interest_type_id' => 'int',
        'person_legal_interest_type_id' => 'int',
        'person_address_id' => 'int',
        'authorized_agent_person_id' => 'int',
    ];

    protected $fillable = [
        'subfile_id',
        'person_id',
        'person_open_date',
        'person_close_date',
        'person_status',
        'person_type',
        'category',
        'cert_mail',
        'cid_no',
        'person_email',
        'person_telephone',
        'mailing_address_address1',
        'mailing_address_address2',
        'mailing_address_city',
        'mailing_address_county',
        'mailing_address_postal_code',
        'mailing_address_state',
        'authorized_agent_last_name',
        'authorized_agent_first_name',
        'authorized_agent_middle_initial',
        'authorized_agent_title',
        'authorized_agent_firm',
        'is_authorized_agent',
        'is_permittee',
        'is_defendant',
        'defendant_type_id',
        'owner_set',
        'person_interest_type_id',
        'person_legal_interest_type_id',
        'person_address_id',
        'authorized_agent_person_id',
        'created_by',
        'updated_by',
    ];

    public function defendant_type()
    {
        return $this->belongsTo(DefendantType::class);
    }

    public function person_address()
    {
        return $this->belongsTo(PersonAddress::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function person_interest_type()
    {
        return $this->belongsTo(PersonInterestType::class);
    }

    public function person_legal_interest_type()
    {
        return $this->belongsTo(PersonLegalInterestType::class);
    }

    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }

    public function authorized_agent_person()
    {
        return $this->belongsTo(Person::class, 'authorized_agent_person_id');
    }
}
