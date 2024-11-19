<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class GroundPod
 *
 * @property int $id
 * @property int|null $arcgis_processing_id
 * @property int $pod_id
 * @property string|null $ground_pod_source_text
 * @property string|null $pump_code
 * @property string|null $power_source
 * @property string|null $source_ug
 * @property float|null $diameter_in
 * @property string|null $dom_map_label
 * @property string|null $pod_wuc
 * @property Carbon|null $log_filed
 * @property int|null $outside_adjudication_section
 * @property int|null $irrigation_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|GroundPodComment[] $ground_pod_comments
 */
class GroundPod extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ground_pods';

    protected $casts = [
        'arcgis_processing_id' => 'int',
        'pod_id' => 'int',
        'diameter_in' => 'float',
        'log_filed' => 'datetime',
        'outside_adjudication_section' => 'int',
        'irrigation_id' => 'int',
    ];

    protected $fillable = [
        'arcgis_processing_id',
        'pod_id',
        'ground_pod_source_text',
        'pump_code',
        'power_source',
        'source_ug',
        'diameter_in',
        'dom_map_label',
        'pod_wuc',
        'log_filed',
        'outside_adjudication_section',
        'irrigation_id',
        'created_by',
        'updated_by',
    ];

    public function ground_pod_comments()
    {
        return $this->hasMany(GroundPodComment::class);
    }

    public function pod(): BelongsTo
    {
        return $this->belongsTo(Pod::class);
    }
}
