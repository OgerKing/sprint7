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
 * Class UserSetting
 *
 * @property int $id
 * @property string $created_by
 * @property string $display_name
 * @property string $initials
 * @property string $updated_by
 * @property string $watch_subfile_changes_frequency
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $user_id
 * @property User|null $user
 */
class UserSetting extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'user_settings';

    protected $casts = [
        'user_id' => 'int',
    ];

    protected $fillable = [
        'created_by',
        'display_name',
        'initials',
        'updated_by',
        'watch_subfile_changes_frequency',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
