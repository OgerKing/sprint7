<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SubfileOwnerHistory
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $contact_email_id
 * @property int $person_telephone_id
 * @property string $created_by
 * @property int $defendant_type_id
 * @property int $person_address_id
 * @property int $person_id
 * @property int $person_interest_type_id
 * @property int $prev_oid
 * @property int $subfile_persons_id
 * @property Carbon $trans_date
 * @property int $transaction_id
 * @property string $updated_by
 */
class SubfileOwnerHistory extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfile_owner_histories';

    protected $casts = [
        'contact_email_id' => 'int',
        'person_telephone_id' => 'int',
        'defendant_type_id' => 'int',
        'person_address_id' => 'int',
        'person_id' => 'int',
        'person_interest_type_id' => 'int',
        'prev_oid' => 'int',
        'subfile_persons_id' => 'int',
        'trans_date' => 'datetime',
        'transaction_id' => 'int',
    ];

    protected $fillable = [
        'contact_email_id',
        'person_telephone_id',
        'created_by',
        'defendant_type_id',
        'person_address_id',
        'person_id',
        'person_interest_type_id',
        'prev_oid',
        'subfile_persons_id',
        'trans_date',
        'transaction_id',
        'updated_by',
    ];
}
