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
 * Class PersonAlias
 *
 * @property int $id
 * @property int $person_id
 * @property int $person_alias_type_id
 * @property string $entity_name
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property Person $person
 * @property PersonAliasType $person_alias_type
 */
class PersonAlias extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'person_aliases';

    protected $casts = [
        'person_id' => 'int',
        'person_alias_type_id' => 'int',
    ];

    protected $fillable = [
        'person_id',
        'person_alias_type_id',
        'entity_name',
        'first_name',
        'last_name',
        'middle_name',
        'created_by',
        'updated_by',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function person_alias_type()
    {
        return $this->belongsTo(PersonAliasType::class);
    }
}
