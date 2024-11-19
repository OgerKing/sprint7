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
 * Class ClaimResolution
 *
 * @property int $id
 * @property string $claim_resolution_code
 * @property string $claim_resolution_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|SubfileClaim[] $subfile_claims
 */
class ClaimResolution extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'claim_resolutions';

    protected $fillable = [
        'claim_resolution_code',
        'claim_resolution_description',
        'created_by',
        'updated_by',
    ];

    public function subfile_claims()
    {
        return $this->hasMany(SubfileClaim::class);
    }
}
