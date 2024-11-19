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
 * Class PersonAliasType
 *
 * @property int $id
 * @property string $person_alias_type_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|PersonAlias[] $person_aliases
 */
class PersonAliasType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'person_alias_types';

    protected $fillable = [
        'person_alias_type_name',
        'created_by',
        'updated_by',
    ];

    public function person_aliases()
    {
        return $this->hasMany(PersonAlias::class);
    }
}
