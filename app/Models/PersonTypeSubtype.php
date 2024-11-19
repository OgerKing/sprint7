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
 * Class PersonTypeSubtype
 *
 * @property int $id
 * @property string $person_type_subtype_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Person[] $people
 */
class PersonTypeSubtype extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'person_type_subtypes';

    protected $fillable = [
        'person_type_subtype_name',
        'created_by',
        'updated_by',
    ];

    public function people()
    {
        return $this->hasMany(Person::class, 'person_subtype_id');
    }
}
