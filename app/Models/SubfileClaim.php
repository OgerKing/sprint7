<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SubfileClaim
 *
 * @property int $id
 * @property int $subfile_id
 * @property string|null $claim_title
 * @property int|null $claim_type_id
 * @property int|null $claim_status_id
 * @property int|null $claim_person
 * @property Carbon|null $claim_open_date
 * @property Carbon|null $claim_close_date
 * @property int|null $claim_resolution_id
 * @property bool|null $court_eo
 * @property int|null $resources_id
 * @property int|null $attorney_id
 * @property string|null $subfile_claim_explanation
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Subfile $subfile
 * @property Attorney|null $attorney
 * @property ClaimResolution|null $claim_resolution
 * @property ClaimType|null $claim_type
 * @property ClaimStatus|null $claim_status
 * @property resource|null $resource
 */
class SubfileClaim extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfile_claims';

    protected $casts = [
        'subfile_id' => 'int',
        'claim_type_id' => 'int',
        'claim_status_id' => 'int',
        'claim_person' => 'int',
        'claim_open_date' => 'datetime',
        'claim_close_date' => 'datetime',
        'claim_resolution_id' => 'int',
        'court_eo' => 'bool',
        'resources_id' => 'int',
        'attorney_id' => 'int',
    ];

    protected $fillable = [
        'subfile_id',
        'claim_title',
        'claim_type_id',
        'claim_status_id',
        'claim_person',
        'claim_open_date',
        'claim_close_date',
        'claim_resolution_id',
        'court_eo',
        'resources_id',
        'attorney_id',
        'subfile_claim_explanation',
        'created_by',
        'updated_by',
    ];

    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }

    public function claim_resolution()
    {
        return $this->belongsTo(ClaimResolution::class);
    }

    public function claim_type()
    {
        return $this->belongsTo(ClaimType::class);
    }

    public function claim_status()
    {
        return $this->belongsTo(ClaimStatus::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resources_id');
    }
}
