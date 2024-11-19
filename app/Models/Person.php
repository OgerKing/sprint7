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
 * Class Person
 *
 * @property int $id
 * @property int $person_type_id
 * @property int|null $person_subtype_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $suffix
 * @property Carbon|null $person_start_date
 * @property Carbon|null $person_end_date
 * @property int $person_status_id
 * @property int|null $is_deceased
 * @property int|null $verified
 * @property int|null $person_address_id
 * @property int|null $person_email_id
 * @property int|null $person_telephone_id
 * @property string|null $special_handling_instructions
 * @property string|null $department
 * @property string|null $division
 * @property string|null $entity_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property PersonAddress|null $person_address
 * @property PersonEmail|null $person_email
 * @property PersonStatus $person_status
 * @property PersonTelephone|null $person_telephone
 * @property PersonType|null $person_type
 * @property PersonTypeSubtype|null $person_type_subtype
 * @property Collection|DefendantDocument[] $defendant_documents
 * @property Collection|GlobalDocument[] $global_documents
 * @property Collection|HydrographicDocument[] $hydrographic_documents
 * @property Collection|OwnerComment[] $owner_comments
 * @property Collection|PersonAlias[] $person_aliases
 * @property Collection|SubfilePerson[] $subfile_people
 */
class Person extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'persons';

    protected $casts = [
        'person_type_id' => 'int',
        'person_subtype_id' => 'int',
        'person_start_date' => 'datetime',
        'person_end_date' => 'datetime',
        'person_status_id' => 'int',
        'is_deceased' => 'int',
        'verified' => 'int',
        'person_address_id' => 'int',
        'person_email_id' => 'int',
        'person_telephone_id' => 'int',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'person_type_id',
        'person_subtype_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'person_start_date',
        'person_end_date',
        'person_status_id',
        'is_deceased',
        'verified',
        'person_address_id',
        'person_email_id',
        'person_telephone_id',
        'special_handling_instructions',
        'department',
        'division',
        'entity_name',
        'created_by',
        'updated_by',
    ];

    public function person_address()
    {
        return $this->belongsTo(PersonAddress::class);
    }

    public function person_email()
    {
        return $this->belongsTo(PersonEmail::class);
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

    public function person_type_subtype()
    {
        return $this->belongsTo(PersonTypeSubtype::class, 'person_subtype_id');
    }

    public function defendant_documents()
    {
        return $this->belongsToMany(DefendantDocument::class, 'defendant_document_persons')
            ->withPivot('id', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function global_documents()
    {
        return $this->belongsToMany(GlobalDocument::class, 'global_document_persons')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function hydrographic_documents()
    {
        return $this->belongsToMany(HydrographicDocument::class, 'hydrographic_document_persons')
            ->withPivot('id', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function owner_comments()
    {
        return $this->hasMany(OwnerComment::class);
    }

    public function person_aliases()
    {
        return $this->hasMany(PersonAlias::class);
    }

    public function subfile_people()
    {
        return $this->hasMany(SubfilePerson::class);
    }

    public function subfiles()
    {
        return $this->hasManyThrough(Subfile::class, SubfilePerson::class, 'person_id', 'id', 'id', 'subfile_id');
    }
}
