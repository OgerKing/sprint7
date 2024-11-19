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
 * Class PodType
 *
 * @property int $id
 * @property string $pod_type_description
 * @property string $pod_type_category
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Pod[] $pods
 */
class PodType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pod_types';

    protected $fillable = [
        'pod_type_description',
        'pod_type_category',
        'created_by',
        'updated_by',
    ];

    public function pods()
    {
        return $this->hasMany(Pod::class);
    }
}
