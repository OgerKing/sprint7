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
 * Class PersonTelephone
 *
 * @property int $id
 * @property string $primary_person_telephone_anumber
 * @property int|null $primary_person_telephone_number_verified
 * @property string $secondary_person_telephone_number
 * @property int $secondary_person_telephone_number_verified
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|OwnerComment[] $owner_comments
 * @property Collection|Person[] $people
 */
class PersonTelephone extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'person_telephones';

    protected $casts = [
        'primary_person_telephone_number_verified' => 'int',
        'secondary_person_telephone_number_verified' => 'int',
    ];

    protected $fillable = [
        'primary_person_telephone_anumber',
        'primary_person_telephone_number_verified',
        'secondary_person_telephone_number',
        'secondary_person_telephone_number_verified',
        'created_by',
        'updated_by',
    ];

    public function owner_comments()
    {
        return $this->hasMany(OwnerComment::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
