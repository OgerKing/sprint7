<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class RoleHasPermission
 *
 * @property int $permission_id
 * @property int $role_id
 * @property Permission $permission
 * @property Role $role
 */
class RoleHasPermission extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'role_has_permissions';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'permission_id' => 'int',
        'role_id' => 'int',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
