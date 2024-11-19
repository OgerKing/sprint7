<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PersonType
 *
 * @property int $id
 * @property string $person_type_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|OwnerComment[] $owner_comments
 * @property Collection|Person[] $people
 */
class PersonType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'person_types';

    protected $fillable = [
        'person_type_name',
        'created_by',
        'updated_by',
    ];

    public function owner_comments(): HasMany
    {
        return $this->hasMany(OwnerComment::class);
    }

    public function people(): HasMany
    {
        return $this->hasMany(Person::class, 'person_telephone_id');
    }

    public function person_type_subtypes(): HasMany
    {
        return $this->hasMany(PersonTypeSubtype::class);
    }
}
