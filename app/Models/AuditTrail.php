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
 * Class AuditTrail
 *
 * @property int $id
 * @property string $operation_type
 * @property string $row_values
 * @property int $source_id
 * @property string $source_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class AuditTrail extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'audit_trails';

    protected $casts = [
        'source_id' => 'int',
    ];

    protected $fillable = [
        'operation_type',
        'row_values',
        'source_id',
        'source_name',
        'created_by',
        'updated_by',
    ];
}
