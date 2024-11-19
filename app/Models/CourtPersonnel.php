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
 * Class CourtPersonnel
 *
 * @property int $id
 * @property int $court_role_id
 * @property int $court_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_initial
 * @property string|null $signature_image_url
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Court $court
 * @property CourtRole $court_role
 * @property Collection|CourtCase[] $court_cases
 */
class CourtPersonnel extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'court_personnel';

    protected $casts = [
        'court_role_id' => 'int',
        'court_id' => 'int',
    ];

    protected $fillable = [
        'court_role_id',
        'court_id',
        'first_name',
        'last_name',
        'middle_initial',
        'signature_image_url',
        'created_by',
        'updated_by',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function court_role()
    {
        return $this->belongsTo(CourtRole::class);
    }

    public function court_cases()
    {
        return $this->hasMany(CourtCase::class, 'court_master_id');
    }
}
