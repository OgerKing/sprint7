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
 * Class OwnerComment
 *
 * @property int $id
 * @property string $comment
 * @property int $contact_email_id
 * @property int $person_telephone_id
 * @property int $person_id
 * @property int $person_status_id
 * @property int $person_type_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property PersonEmail $person_email
 * @property Person $person
 * @property PersonStatus $person_status
 * @property PersonTelephone $person_telephone
 * @property PersonType $person_type
 */
class OwnerComment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'owner_comments';

    protected $casts = [
        'contact_email_id' => 'int',
        'person_telephone_id' => 'int',
        'person_id' => 'int',
        'person_status_id' => 'int',
        'person_type_id' => 'int',
    ];

    protected $fillable = [
        'comment',
        'contact_email_id',
        'person_telephone_id',
        'person_id',
        'person_status_id',
        'person_type_id',
        'created_by',
        'updated_by',
    ];

    public function person_email()
    {
        return $this->belongsTo(PersonEmail::class, 'contact_email_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function person_status()
    {
        return $this->belongsTo(PersonStatus::class);
    }

    public function person_telephone()
    {
        return $this->belongsTo(PersonTelephone::class);
    }

    public function person_type()
    {
        return $this->belongsTo(PersonType::class);
    }
}
