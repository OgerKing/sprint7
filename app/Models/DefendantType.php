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
 * Class DefendantType
 *
 * @property int $id
 * @property string $created_by
 * @property string $defendant_type_description
 * @property string $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|SubfilePerson[] $subfile_people
 */
class DefendantType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'defendant_types';

    protected $fillable = [
        'created_by',
        'defendant_type_description',
        'updated_by',
    ];

    public function subfile_people()
    {
        return $this->hasMany(SubfilePerson::class);
    }
}
