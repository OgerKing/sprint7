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
 * Class PodNameHistory
 *
 * @property int $id
 * @property int $pod_id
 * @property string $pod_basin
 * @property string $pod_nbr
 * @property string $pod_suffix
 * @property Carbon|null $end_date
 * @property int|null $proposed
 * @property int $s_id_access
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class PodNameHistory extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pod_name_histories';

    protected $casts = [
        'pod_id' => 'int',
        'end_date' => 'datetime',
        'proposed' => 'int',
        's_id_access' => 'int',
    ];

    protected $fillable = [
        'pod_id',
        'pod_basin',
        'pod_nbr',
        'pod_suffix',
        'end_date',
        'proposed',
        's_id_access',
        'created_by',
        'updated_by',
    ];
}
