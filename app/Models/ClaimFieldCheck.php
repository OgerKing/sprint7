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
 * Class ClaimFieldCheck
 *
 * @property int $id
 * @property string $field_work_code
 * @property int $field_work_id
 * @property string $fld_work_notes
 * @property Carbon $fld_wrk_date
 * @property int $fld_wrk_id
 * @property int $resource_id
 * @property int $sub_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property FieldWork $field_work
 * @property resource $resource
 */
class ClaimFieldCheck extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'claim_field_checks';

    protected $casts = [
        'field_work_id' => 'int',
        'fld_wrk_date' => 'datetime',
        'fld_wrk_id' => 'int',
        'resource_id' => 'int',
        'sub_id' => 'int',
    ];

    protected $fillable = [
        'field_work_code',
        'field_work_id',
        'fld_work_notes',
        'fld_wrk_date',
        'fld_wrk_id',
        'resource_id',
        'sub_id',
        'created_by',
        'updated_by',
    ];

    public function field_work()
    {
        return $this->belongsTo(FieldWork::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
