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
 * Class PouNonIrrigation
 *
 * @property int $id
 * @property int $pou_id
 * @property int|null $arcgis_processing_id
 * @property string|null $map_id_desc
 * @property string|null $zone
 * @property int|null $r_id_access
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Pou $pou
 */
class PouNonIrrigation extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    // use SoftDeletes;

    protected $table = 'pou_non_irrigations';

    protected $casts = [
        'pou_id' => 'int',
        'arcgis_processing_id' => 'int',
        'r_id_access' => 'int',
    ];

    protected $fillable = [
        'pou_id',
        'arcgis_processing_id',
        'map_id_desc',
        'zone',
        'r_id_access',
        'created_by',
        'updated_by',
    ];

    public function pou()
    {
        return $this->belongsTo(Pou::class);
    }
}
