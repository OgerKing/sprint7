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
 * Class GlobalDocumentWaterRight
 *
 * @property int $id
 * @property int $global_document_id
 * @property int $water_right_id
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property GlobalDocument $global_document
 * @property WaterRight $water_right
 */
class GlobalDocumentWaterRight extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'global_document_water_rights';

    protected $casts = [
        'global_document_id' => 'int',
        'water_right_id' => 'int',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'global_document_id',
        'water_right_id',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function global_document()
    {
        return $this->belongsTo(GlobalDocument::class);
    }

    public function water_right()
    {
        return $this->belongsTo(WaterRight::class);
    }
}
