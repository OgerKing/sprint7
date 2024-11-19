<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PersonInterestType
 *
 * @property int $id
 * @property string $person_interest_type
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|SubfilePerson[] $subfile_people
 */
class PersonInterestType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'person_interest_types';

    protected $fillable = [
        'person_interest_type',
        'created_by',
        'updated_by',
    ];

    public function subfile_people()
    {
        return $this->hasMany(SubfilePerson::class);
    }
}
