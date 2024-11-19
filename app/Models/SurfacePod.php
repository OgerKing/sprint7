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
 * Class SurfacePod
 *
 * @property int $id
 * @property int $arcgis_processing_id
 * @property int $pod_id
 * @property string $ditch_name_hl
 * @property string $ditch_name_aka
 * @property string $surface_pod_source_text
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property ArcgisProcessing $arcgis_processing
 * @property Pod $pod
 */
class SurfacePod extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'surface_pods';

    protected $casts = [
        'arcgis_processing_id' => 'int',
        'pod_id' => 'int',
    ];

    protected $fillable = [
        'arcgis_processing_id',
        'pod_id',
        'ditch_name_hl',
        'ditch_name_aka',
        'surface_pod_source_text',
        'created_by',
        'updated_by',
    ];

    public function arcgis_processing()
    {
        return $this->belongsTo(ArcgisProcessing::class);
    }

    public function pod()
    {
        return $this->belongsTo(Pod::class);
    }
}
