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
 * Class WratsUser
 *
 * @property int $id
 * @property string $ad_user_name
 * @property string $created_by
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|SubfileUserWatch[] $subfile_user_watches
 * @property Collection|WratsUserEmailNotification[] $wrats_user_email_notifications
 * @property Collection|Subfile[] $subfiles
 */
class WratsUser extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'wrats_users';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'ad_user_name',
        'created_by',
        'email',
        'email_verified_at',
        'updated_by',
    ];

    public function subfile_user_watches()
    {
        return $this->hasMany(SubfileUserWatch::class);
    }

    public function wrats_user_email_notifications()
    {
        return $this->hasMany(WratsUserEmailNotification::class);
    }

    public function subfiles()
    {
        return $this->belongsToMany(Subfile::class, 'wrats_user_subfile_notifications')
            ->withPivot('id', 'file_location_id', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}
