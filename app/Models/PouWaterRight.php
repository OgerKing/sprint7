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
 * Class PouWaterRight
 *
 * @property int $id
 * @property int $pou_id
 * @property int $water_right_id
 * @property string|null $priority_date
 * @property string|null $priority_date_text
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property Pou $pou
 * @property WaterRight $water_right
 */
class PouWaterRight extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pou_water_rights';

    protected $casts = [
        'pou_id' => 'int',
        'water_right_id' => 'int',
    ];

    protected $fillable = [
        'pou_id',
        'water_right_id',
        'priority_date',
        'priority_date_text',
        'created_by',
        'updated_by',
    ];

    public function pou()
    {
        return $this->belongsTo(Pou::class);
    }

    public function water_right()
    {
        return $this->belongsTo(WaterRight::class);
    }
}
