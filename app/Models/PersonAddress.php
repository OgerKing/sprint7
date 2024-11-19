<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PersonAddress
 *
 * @property int $id
 * @property string $mailing_address_address_1
 * @property string $mailing_address_address_2
 * @property string $mailing_address_city
 * @property string $mailing_address_country
 * @property int $mailing_address_postal_code
 * @property string $mailing_address_state
 * @property int|null $mailing_address_verified
 * @property string $physical_address_address_1
 * @property string $physical_address_address_2
 * @property string $physical_address_city
 * @property string $physical_address_country
 * @property int $physical_address_postal_code
 * @property string $physical_address_state
 * @property int|null $physical_address_verified
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Person[] $people
 */
class PersonAddress extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'person_addresses';

    protected $casts = [
        'mailing_address_postal_code' => 'int',
        'mailing_address_verified' => 'int',
        'physical_address_postal_code' => 'int',
        'physical_address_verified' => 'int',
    ];

    protected $fillable = [
        'mailing_address_address_1',
        'mailing_address_address_2',
        'mailing_address_city',
        'mailing_address_country',
        'mailing_address_postal_code',
        'mailing_address_state',
        'mailing_address_verified',
        'physical_address_address_1',
        'physical_address_address_2',
        'physical_address_city',
        'physical_address_country',
        'physical_address_postal_code',
        'physical_address_state',
        'physical_address_verified',
        'created_by',
        'updated_by',
    ];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
