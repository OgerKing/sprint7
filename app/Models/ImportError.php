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
 * Class ImportError
 *
 * @property int $id
 * @property Carbon $error_datetime
 * @property string $error_description
 * @property int $arcgis_processing_id
 * @property string $table_name
 * @property string $user_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property ArcgisProcessing $arcgis_processing
 */
class ImportError extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'import_errors';

    protected $casts = [
        'error_datetime' => 'datetime',
        'arcgis_processing_id' => 'int',
    ];

    protected $fillable = [
        'error_datetime',
        'error_description',
        'arcgis_processing_id',
        'table_name',
        'user_name',
        'created_by',
        'updated_by',
    ];

    public function arcgis_processing()
    {
        return $this->belongsTo(ArcgisProcessing::class);
    }
}
