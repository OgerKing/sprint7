<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PersonEmail
 *
 * @property int $id
 * @property string $primary_contact_email
 * @property int|null $primary_contact_email_verified
 * @property string $secondary_contact_email
 * @property int $secondary_contact_email_verified
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|OwnerComment[] $owner_comments
 * @property Collection|Person[] $people
 */
class PersonEmail extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'person_emails';

    protected $casts = [
        'primary_contact_email_verified' => 'int',
        'secondary_contact_email_verified' => 'int',
    ];

    protected $fillable = [
        'primary_contact_email',
        'primary_contact_email_verified',
        'secondary_contact_email',
        'secondary_contact_email_verified',
        'created_by',
        'updated_by',
    ];

    public function owner_comments()
    {
        return $this->hasMany(OwnerComment::class, 'contact_email_id');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
