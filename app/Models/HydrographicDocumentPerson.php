<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class HydrographicDocumentPerson
 *
 * @property int $id
 * @property int $hydrographic_document_id
 * @property int $person_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Person $person
 * @property HydrographicDocument $hydrographic_document
 */
class HydrographicDocumentPerson extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'hydrographic_document_persons';

    protected $casts = [
        'hydrographic_document_id' => 'int',
        'person_id' => 'int',
    ];

    protected $fillable = [
        'hydrographic_document_id',
        'person_id',
        'created_by',
        'updated_by',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function hydrographic_document()
    {
        return $this->belongsTo(HydrographicDocument::class);
    }
}
