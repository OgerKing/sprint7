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
 * Class Irrigation
 *
 * @property int $id
 * @property string $pod_is
 * @property string $pod_is_description
 * @property string $updated_by
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property Collection|GroundPod[] $ground_pods
 */
class Irrigation extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'irrigations';

    protected $fillable = [
        'pod_is',
        'pod_is_description',
        'updated_by',
        'created_by',
    ];
}
