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
 * Class CourtRole
 *
 * @property int $id
 * @property string $court_role
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|CourtPersonnel[] $court_personnels
 */
class CourtRole extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'court_roles';

    protected $fillable = [
        'court_role',
        'created_by',
        'updated_by',
    ];

    public function court_personnels()
    {
        return $this->hasMany(CourtPersonnel::class);
    }
}
