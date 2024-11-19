<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ModelHasPermission
 *
 * @property int $permission_id
 * @property string $model_type
 * @property int $model_id
 * @property Permission $permission
 */
class ModelHasPermission extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'model_has_permissions';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'permission_id' => 'int',
        'model_id' => 'int',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
