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
 * Class WatersStatus
 *
 * @property int $id
 * @property string $waters_status_code
 * @property string $waters_status_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class WatersStatus extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'waters_statuses';

    protected $fillable = [
        'waters_status_code',
        'waters_status_description',
        'created_by',
        'updated_by',
    ];
}
