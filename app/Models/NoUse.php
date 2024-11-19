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
 * Class NoUs
 *
 * @property int $id
 * @property int $pou_id
 * @property string $map_serial
 * @property float $assigned_acres
 * @property int $pou_id_access
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class NoUse extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'no_uses';

    protected $casts = [
        'pou_id' => 'int',
        'assigned_acres' => 'float',
        'pou_id_access' => 'int',
    ];

    protected $fillable = [
        'pou_id',
        'map_serial',
        'assigned_acres',
        'pou_id_access',
        'created_by',
        'updated_by',
    ];

    public function pou()
    {
        return $this->belongsTo(Pou::class);
    }
}
