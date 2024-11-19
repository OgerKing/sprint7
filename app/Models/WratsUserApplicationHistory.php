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
 * Class WratsUserApplicationHistory
 *
 * @property int $id
 * @property string $label
 * @property string $parameters
 * @property string $path
 * @property string $record_type
 * @property int $users_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 */
class WratsUserApplicationHistory extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'wrats_user_application_history';

    protected $casts = [
        'users_id' => 'int',
    ];

    protected $fillable = [
        'label',
        'parameters',
        'path',
        'record_type',
        'users_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
