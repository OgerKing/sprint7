<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PodWaterRight
 *
 * @property int $id
 * @property int $pod_id
 * @property int $water_right_id
 * @property float $acres_pri
 * @property float $acre_ft_pri
 * @property float $percent_cfs
 * @property string|null $priority_date
 * @property string|null $priority_date_text
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property Pod $pod
 * @property WaterRight $water_right
 */
class PodWaterRight extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pod_water_rights';

    protected $casts = [

        'priority_date' => 'date',
        'water_right_id' => 'int',
        'acres_pri' => 'float',
        'acre_ft_pri' => 'float',
        'percent_cfs' => 'float',
    ];

    protected $fillable = [
        'pod_id',
        'water_right_id',
        'acres_pri',
        'acre_ft_pri',
        'percent_cfs',
        'priority_date',
        'priority_date_text',
        'created_by',
        'updated_by',
    ];

    public function pod()
    {
        return $this->belongsTo(Pod::class);
    }

    public function water_right()
    {
        return $this->belongsTo(WaterRight::class);
    }
}
