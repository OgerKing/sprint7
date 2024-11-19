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
 * Class GroundPodComment
 *
 * @property int $id
 * @property string $ground_pod_comment
 * @property int $ground_pod_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property GroundPod $ground_pod
 */
class GroundPodComment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ground_pod_comments';

    protected $casts = [
        'ground_pod_id' => 'int',
    ];

    protected $fillable = [
        'ground_pod_comment',
        'ground_pod_id',
        'created_by',
        'updated_by',
    ];

    public function ground_pod()
    {
        return $this->belongsTo(GroundPod::class);
    }
}
