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
 * Class DefendantDocumentPerson
 *
 * @property int $id
 * @property int $defendant_document_id
 * @property int $person_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property DefendantDocument $defendant_document
 * @property Person $person
 */
class DefendantDocumentPerson extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'defendant_document_persons';

    protected $casts = [
        'defendant_document_id' => 'int',
        'person_id' => 'int',
    ];

    protected $fillable = [
        'defendant_document_id',
        'person_id',
        'created_by',
        'updated_by',
    ];

    public function defendant_document()
    {
        return $this->belongsTo(DefendantDocument::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
