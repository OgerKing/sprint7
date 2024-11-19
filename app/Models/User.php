<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $guid
 * @property string|null $domain
 * @property Carbon|null $first_login
 * @property Collection|Bureau[] $bureaus
 * @property Collection|UserSetting[] $user_settings
 * @property Collection|WratsUserApplicationHistory[] $wrats_user_application_histories
 */
class User extends Authenticatable implements Auditable
{
    use AuthenticatesWithLdap, Notifiable;
    use HasFactory;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'users';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'first_login' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'guid',
        'domain',
        'first_login',
    ];

    public function bureaus()
    {
        return $this->belongsToMany(Bureau::class, 'bureau_users')
            ->withPivot('id', 'gis_duplicate_id', 'login_name', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function user_settings()
    {
        return $this->hasMany(UserSetting::class);
    }

    public function wrats_user_application_histories()
    {
        return $this->hasMany(WratsUserApplicationHistory::class, 'users_id');
    }

    public function getLdapDomainColumn(): string
    {
        return 'my_domain_column';
    }

    public function getLdapGuidColumn(): string
    {
        return 'my_guid_column';
    }

    public function watchedSubfiles()
    {
        return $this->belongsToMany(Subfile::class, 'subfile_user_watch', 'wrats_user_id', 'subfile_id')
            ->withTimestamps();
    }
}
