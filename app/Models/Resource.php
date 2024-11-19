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
 * Class Resource
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|ClaimFieldCheck[] $claim_field_checks
 * @property Collection|SubfileClaim[] $subfile_claims
 */
class Resource extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'resources';

    protected $fillable = [
        'first_name',
        'last_name',
        'created_by',
        'updated_by',
    ];

    public function claim_field_checks()
    {
        return $this->hasMany(ClaimFieldCheck::class);
    }

    public function subfile_claims()
    {
        return $this->hasMany(SubfileClaim::class, 'resources_id');
    }
}
