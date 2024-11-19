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
 * Class WaterRightUse
 *
 * @property int $id
 * @property string $water_right_use_code
 * @property string $water_right_use_description
 * @property int $domestic
 * @property int $acres
 * @property int $use_type_nbr
 * @property int|null $old_only
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|WaterRight[] $water_rights
 */
class WaterRightUse extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'water_right_uses';

    protected $casts = [
        'domestic' => 'int',
        'acres' => 'int',
        'use_type_nbr' => 'int',
        'old_only' => 'int',
    ];

    protected $fillable = [
        'water_right_use_code',
        'water_right_use_description',
        'domestic',
        'acres',
        'use_type_nbr',
        'old_only',
        'created_by',
        'updated_by',
    ];

    public function water_rights()
    {
        return $this->hasMany(WaterRight::class, 'water_right_use_id');
    }
}
