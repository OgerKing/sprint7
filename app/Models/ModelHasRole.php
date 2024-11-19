<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ModelHasRole
 *
 * @property int $role_id
 * @property string $model_type
 * @property int $model_id
 * @property Role $role
 */
class ModelHasRole extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'model_has_roles';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'role_id' => 'int',
        'model_id' => 'int',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
